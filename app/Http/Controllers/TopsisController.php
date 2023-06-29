<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Topsis;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class TopsisController extends Controller
{
    public function index() {

        $topsis = DB::table("topsis")->select("topsis.*", "periode.*")->join("periode", "periode.id_periode", "=", "topsis.id_periode");
        $periode = Periode::all();
        return view('perhitungan.topsis', compact('topsis', 'periode'));
    }

    public function hasil() {

        $topsis = DB::table("topsis")->select("topsis.*", "periode.*")->join("periode", "periode.id_periode", "=", "topsis.id_periode");
        $periode = Periode::all();
        return view('perhitungan.hasil_perhitungan', compact('topsis', 'periode'));
    }

    public function perangkingan( $id_topsis ) {

        $topsis = DB::table("topsis")->select("topsis.*", "periode.*")->join("periode", "periode.id_periode", "=", "topsis.id_periode")
        ->where('id_topsis', $id_topsis)->first();
        return view('perhitungan.perangkingan', compact('topsis'));
    }
    
    public function detail( $id_topsis ) {

        $topsis = DB::table("topsis")->select("topsis.*", "periode.*")->join("periode", "periode.id_periode", "=", "topsis.id_periode")
        ->where('id_topsis', $id_topsis)->first();
        return view('perhitungan.detail', compact('topsis'));
    }
    //

    public function reset() {

        DB::table("topsis")->truncate();

        return redirect('topsis');
    }

    public function main( Request $request ) {

        /**
         *  1. menyiapkan dataset
         *  2. matrix penilaian
         *  3. menyiapkan rata-rata bobot prioritas
         *  4. Normalisasi 
         *  5. Normalisasi Terbobot
         *  6. Solusi Ideal Positif
         *  7. Solusi Ideal Negatif
         *  8. Menentukan jarak alternatif dengan solusi ideal positif
         *  9. -- " -- ideal negatif
         *  10. Menghitung jarak relatif alternatif terhadap solusi ideal positif
         *  11. Keputusan atau perangkingan
         */

         // @TODO 3 : rata rata bobot prioritas 
        $dt_bobot = DB::table("ahp")->first();

        $id_periode = $request->id_periode;
        // @TODO 1 : menyiapkan dataset 
        $dataset = DB::table("data_alternatif")
                        ->select("data_alternatif.*", "data_siswa.*")
                        ->join("data_siswa", "data_siswa.id_siswa", "=", "data_alternatif.id_siswa")
                        ->where("data_alternatif.id_periode", $id_periode);

        if  ( $dataset->count() > 0 ) {

            // @TODO 2 : matrix penilaian
            $dataset = $dataset->get();
            $dt_matrix_penilaian = $this->matrix_penilaian( $dataset );

            
            if ( $dt_bobot->bobot_prioritas ) {

                // lanjut 
                $dt_bobot = json_decode( $dt_bobot->bobot_prioritas );
                


                // @TODO 4 : Normalisasi
                $dt_normalisasi = $this->matrix_normalisasi( $dt_matrix_penilaian );


                // @TODO 5 : Normalisasi Terbobot
                $dt_normalisasi_terbobot = $this->matrix_normalisasi_terbobot( $dt_bobot, $dt_normalisasi );

                // memastikan data kritia sudah diisi
                $dt_kriteria_master = DB::table("data_kriteria");
                if ( $dt_kriteria_master->count() > 0 ) {

                    $master_kriteria = $dt_kriteria_master->get();

                    //@TODO 6 + 7 : Solusi Ideal Positif dan negatif
                    $dt_solusi_ideal_positif_negatif = $this->solusi_ideal_positif_negatif($master_kriteria, $dt_normalisasi_terbobot);


                    // @TODO 8 + 9 + 10: Jarak Alternatif 
                    $dt_jarakAlternatif = $this->jarak_alternatif( $dt_solusi_ideal_positif_negatif, $dt_normalisasi_terbobot );

                } else {

                    echo '<script>alert("Whoops kriteria kosong")</script>';
                    return redirect('kriteria');
                }

                $json_matrix_penilaian = json_encode( $dt_matrix_penilaian );
                $json_normalisasi = json_encode( $dt_normalisasi );
                $json_normalisasi_terbobot = json_encode( $dt_normalisasi_terbobot );
                $json_solusi_ideal_positif_negatif = json_encode( $dt_solusi_ideal_positif_negatif );
                $json_relatif = json_encode( $dt_jarakAlternatif );

                // simpan di db
                $dt_insert = array(

                    'id_periode'    => $id_periode,
                    'matrix_penilaian'                  => $json_matrix_penilaian,
                    'normalisasi'                       => $json_normalisasi,
                    'normalisasi_terbobot'              => $json_normalisasi_terbobot,
                    'solusi_ideal_positif_negatif'      => $json_solusi_ideal_positif_negatif,
                    'jarak_relatif'                     => $json_relatif,
                );

                DB::table("topsis")->insert($dt_insert);
                return redirect('topsis');
        


            } else { // ahp belum dihitung

                echo '<script>alert("Whoops AHP belum diproses")</script>';
                return redirect('topsis');
            }
        } else {

            echo '<script>alert("Tidak ditemukan data alternatif berdasarkan periode yang anda pilih");
                window.location.href = "'.url('topsis').'";
            </script>';
            // return redirect('topsis');
        }
    }

    // 2
    function matrix_penilaian( $dataset ) {

        // $index 
        /**
         *  1 : C1
         *  2 : C2 
         *  3 : C3 
         *  4 : C4 
         *  5 : C5 
         *  6 : C6
         */

        $dt_baru = array();
        foreach ( $dataset AS $urutan => $isi ) {

            // echo "<h2>". $isi->nama."</h2>";

            // print_r( $isi );
            // echo "<br>";
            $C1 = $this->penentuanMatrixPenilaian(1, $isi->C1);
            $C2 = $this->penentuanMatrixPenilaian(2, $isi->C2);
            $C3 = $this->penentuanMatrixPenilaian(3, $isi->C3);
            $C4 = $this->penentuanMatrixPenilaian(4, $isi->C4);
            $C5 = $this->penentuanMatrixPenilaian(5, $isi->C5);
            $C6 = $this->penentuanMatrixPenilaian(6, $isi->C6);

            // echo $C1.' | '.$C2.' | '.$C3.' | '.$C4.' | '.$C5.' | '.$C6;
            $isi->m_penilaianC1 = $C1;
            $isi->m_penilaianC2 = $C2;
            $isi->m_penilaianC3 = $C3;
            $isi->m_penilaianC4 = $C4;
            $isi->m_penilaianC5 = $C5;
            $isi->m_penilaianC6 = $C6;

            
            
            array_push( $dt_baru, $isi );
        }

        return $dt_baru;
    }

    // 2.1
    function penentuanMatrixPenilaian( $alternatif, $nilai ) {

        $skor = 0;
        switch ($alternatif) {
            
            case 3: // penentuan rentang nilai C3
                
                if ( ($nilai >= 7) ) {

                    $skor = 5;
                } else if ( $nilai == 6 ) {

                    $skor = 4;
                } else if ( ($nilai >= 4) && ($nilai <= 5) ) {

                    $skor = 3;
                } else if ( ($nilai >= 2) && ($nilai <= 3) ) {

                    $skor = 2;
                } else if ( ($nilai >= 0) && ($nilai <= 1) ) {

                    $skor = 1;
                }
              
                break;
            
            default:
                
                // C2, C4, C5
                if ( $alternatif == 2 || $alternatif == 4 || $alternatif == 5 ){

                    if ( ($nilai == 'A') ) {

                        $skor = 5;
                    } else if ($nilai == 'B' ) {
    
                        $skor = 4;
                    } else if ($nilai == 'C' ) {
    
                        $skor = 3;
                    } else if ($nilai == 'D') {
    
                        $skor = 2;
                    } else if ($nilai == 'E' ) {
    
                        $skor = 1;
                    }
                } // C1 dan C6
                else if ( $alternatif == 1 || $alternatif == 6 ){

                    if ( ($nilai >= 90) && ($nilai <= 100) ) {

                        $skor = 5;
                    } else if ( ($nilai >= 80) && ($nilai <= 89.99) ) {
    
                        $skor = 4;
                    } else if ( ($nilai >= 70) && ($nilai <= 79.99) ) {
    
                        $skor = 3;
                    } else if ( ($nilai >= 60) && ($nilai <= 69.99) ) {
    
                        $skor = 2;
                    } else if ( ($nilai >= 50) && ($nilai <= 59.99) ) {
    
                        $skor = 1;
                    }
                }
                break;
        }

        return $skor;
    }

    // 4
    function matrix_normalisasi( $dt_matrix_penilaian ) {

        $dt_baru = array();
        foreach ( $dt_matrix_penilaian AS $isi ) {

            $FiJC1 = $isi->m_penilaianC1;
            $hs_normalisasiC1 = $this->perhitunganMatrixNormalisasi( $FiJC1, "C1", $dt_matrix_penilaian );
            $isi->m_normalisasiC1 = $hs_normalisasiC1;

            $FiJC2 = $isi->m_penilaianC2;
            $hs_normalisasiC2 = $this->perhitunganMatrixNormalisasi( $FiJC2, "C2", $dt_matrix_penilaian );
            $isi->m_normalisasiC2 = $hs_normalisasiC2;

            $FiJC3 = $isi->m_penilaianC3;
            $hs_normalisasiC3 = $this->perhitunganMatrixNormalisasi( $FiJC3, "C3", $dt_matrix_penilaian );
            $isi->m_normalisasiC3 = $hs_normalisasiC3;

            $FiJC4 = $isi->m_penilaianC4;
            $hs_normalisasiC4 = $this->perhitunganMatrixNormalisasi( $FiJC4, "C4", $dt_matrix_penilaian );
            $isi->m_normalisasiC4 = $hs_normalisasiC4;

            $FiJC5 = $isi->m_penilaianC5;
            $hs_normalisasiC5 = $this->perhitunganMatrixNormalisasi( $FiJC5, "C5", $dt_matrix_penilaian );
            $isi->m_normalisasiC5 = $hs_normalisasiC5;

            $FiJC6 = $isi->m_penilaianC6;
            $hs_normalisasiC6 = $this->perhitunganMatrixNormalisasi( $FiJC6, "C6", $dt_matrix_penilaian );
            $isi->m_normalisasiC6 = $hs_normalisasiC6;

            
            // print_r( $isi );
            // echo "<h2>".number_format($hs_normalisasiC6, 2)."</h2>";
            // echo "<hr>";

            array_push($dt_baru, $isi);


        }

        return $dt_baru;
    }


    // 4.1 
    function perhitunganMatrixNormalisasi( $FiJ, $alt, $dt_matrix_penilaian ) {

        $total = 0;
        $hasil = 0;
        foreach ( $dt_matrix_penilaian AS $isi ) {

            switch( $alt ) {

                case "C1":
                    $total = $total + pow($isi->m_penilaianC1, 2);
                    break;

                case "C2":
                    $total = $total + pow($isi->m_penilaianC2, 2);
                    break;

                case "C3":
                    $total = $total + pow($isi->m_penilaianC3, 2);
                    break;
                
                case "C4":
                    $total = $total + pow($isi->m_penilaianC4, 2);
                    break;

                case "C5":
                    $total = $total + pow($isi->m_penilaianC5, 2);
                    break;

                case "C6":
                    $total = $total + pow($isi->m_penilaianC6, 2);
                    break;
                
            }
        }

        // akar 
        if ( $total > 0 ){

            $akar = sqrt( $total );
            $hasil = $FiJ / $akar;
        }

        return $hasil;
    }


    // 5 
    function matrix_normalisasi_terbobot( $dt_bobot, $dt_normalisasi ) {

        $dt_baru = array();
        foreach ( $dt_normalisasi AS $isi ) {

            // echo "<h2>$isi->id_siswa</h2>";
            
            $Vij_C1 = $this->perhitunganKeputusanNormalisasiBerbobot("C1", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC1 = $Vij_C1;

            $Vij_C2 = $this->perhitunganKeputusanNormalisasiBerbobot("C2", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC2 = $Vij_C2;

            $Vij_C3 = $this->perhitunganKeputusanNormalisasiBerbobot("C3", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC3 = $Vij_C3;

            $Vij_C4 = $this->perhitunganKeputusanNormalisasiBerbobot("C4", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC4 = $Vij_C4;

            $Vij_C5 = $this->perhitunganKeputusanNormalisasiBerbobot("C5", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC5 = $Vij_C5;

            $Vij_C6 = $this->perhitunganKeputusanNormalisasiBerbobot("C6", $dt_bobot, $isi);
            $isi->m_normalisasi_terbobotC6 = $Vij_C6;

            // echo $Vij_C6;
            // echo "<hr>";
            array_push($dt_baru, $isi);
        }
        return $dt_baru;
    }

    // 5.1 
    function perhitunganKeputusanNormalisasiBerbobot( $alt, $bobot, $dt_normalisasi) {

        $hasil = 0;
        // Vij = Wij x Rij
        switch( $alt ) {

            case "C1":
                $hasil = $bobot[0] * $dt_normalisasi->m_normalisasiC1;
                break;

            case "C2":
                $hasil = $bobot[1] * $dt_normalisasi->m_normalisasiC2;
                break;
            
            case "C3":
                $hasil = $bobot[2] * $dt_normalisasi->m_normalisasiC3;
                break;
            
            case "C4":
                $hasil = $bobot[3] * $dt_normalisasi->m_normalisasiC4;
                break;

            case "C5":
                $hasil = $bobot[4] * $dt_normalisasi->m_normalisasiC5;
                break;
            
            case "C6":
                $hasil = $bobot[5] * $dt_normalisasi->m_normalisasiC6;
                break;
        }

        return $hasil;
    }

    // 6
    function solusi_ideal_positif_negatif($master_kriteria, $dt_normalisasi_terbobot){

        $dt_baru = array();
        foreach ( $master_kriteria AS $isi ) {

            // echo "<h1>$isi->variabel</h1>";
            $penentuanPositif = $this->nilaiMinMax( $isi->variabel, $isi->tipe, $dt_normalisasi_terbobot, "positif" );
            $penentuanNegatif = $this->nilaiMinMax( $isi->variabel, $isi->tipe, $dt_normalisasi_terbobot, "negatif" );
            // echo $isi->tipe.' positif = '.$penentuanPositif."<br>";
            // echo $isi->tipe.' negatif = '.$penentuanNegatif;
            // echo "<hr>";

            $isi->solusiPositif = $penentuanPositif;
            $isi->solusiNegatif = $penentuanNegatif;

            array_push( $dt_baru, $isi );
        }

        return $dt_baru;        
    }


    // 6.1 mengambil nilai max or min | jenis = benefit dan cost
    function nilaiMinMax( $alt, $jenis, $V, $bilanganBulat) {

        $hasil = 0;
        $deretanNilai = array();
        foreach ( $V AS $nilai ) {

            switch ($alt) {
                case 'C1':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC1 );
                    break;
                case 'C2':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC2 );
                    break;
                case 'C3':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC3 );
                    break;
                case 'C4':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC4 );
                    break;
                case 'C5':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC5 );
                    break;
                case 'C6':
                    array_push( $deretanNilai, $nilai->m_normalisasi_terbobotC6 );
                    break;
            }
        }
        
        // deret nilai = [0.20  0.22  0.20]
        // print_r( $deretanNilai );


        if ( $bilanganBulat == "positif" ) {

            if ( $jenis == "benefit" ) {

                // benefit
                $hasil = max( $deretanNilai );
            } else {
    
                // cost
                $hasil = min( $deretanNilai );
            }
        } else if ( $bilanganBulat == "negatif" ) {

            if ( $jenis == "benefit" ) {

                // benefit
                $hasil = min( $deretanNilai );
            } else {
    
                // cost
                $hasil = max( $deretanNilai );
            }
        }
        

        return $hasil;
    }


    // 7 Jarak alternatif 
    function jarak_alternatif( $dt_solusi_ideal_positif_negatif, $dt_normalisasi_terbobot ){

        $dt_baru = array();

        // print_r( $dt_solusi_ideal_positif_negatif );
        foreach ( $dt_normalisasi_terbobot AS $isi ) {

            // echo "<h1>$isi->id_siswa</h1>";
            // m_normalisasi_terbobotCn
            // print_r( $isi );
            $positif = $this->perhitunganJarakAlternatif( $isi, $dt_solusi_ideal_positif_negatif )["positif"];
            $negatif= $this->perhitunganJarakAlternatif( $isi, $dt_solusi_ideal_positif_negatif )["negatif"];
            
            $jarak = 0;
            if ( $negatif != 0 && $positif != 0 ) {

                $jarak = $negatif / ($negatif + $positif);
            }
            
            // echo $negatif.' '. $positif;

            $isi->jarakAlternatifPositif = $positif;
            $isi->jarakAlternatifNegatif = $negatif;
            $isi->hasilJarak = $jarak;


            array_push( $dt_baru, $isi );
        }

        // Perangkingan
        usort($dt_baru, fn($a, $b) => $a->hasilJarak < $b->hasilJarak);

        return $dt_baru;
    }


    // 7.1 formula
    function perhitunganJarakAlternatif( $n_terbobot, $dt_solusi_ideal_positif_negatif ) {

        // positif
        $C1 = pow($n_terbobot->m_normalisasi_terbobotC1 - $dt_solusi_ideal_positif_negatif[0]->solusiPositif, 2);
        $C2 = pow($n_terbobot->m_normalisasi_terbobotC2 - $dt_solusi_ideal_positif_negatif[1]->solusiPositif, 2);
        $C3 = pow($n_terbobot->m_normalisasi_terbobotC3 - $dt_solusi_ideal_positif_negatif[2]->solusiPositif, 2);
        $C4 = pow($n_terbobot->m_normalisasi_terbobotC4 - $dt_solusi_ideal_positif_negatif[3]->solusiPositif, 2);
        $C5 = pow($n_terbobot->m_normalisasi_terbobotC5 - $dt_solusi_ideal_positif_negatif[4]->solusiPositif, 2);
        $C6 = pow($n_terbobot->m_normalisasi_terbobotC6 - $dt_solusi_ideal_positif_negatif[5]->solusiPositif, 2);

        $SQRT_positif = sqrt( $C1 + $C2 + $C3 + $C4 + $C5 + $C6);
        // echo "<h5>$C1 = $C2 = $C3 = $C4 = $C5 = $C6</h5>";

        // negatif
        $C1 = pow($n_terbobot->m_normalisasi_terbobotC1 - $dt_solusi_ideal_positif_negatif[0]->solusiNegatif, 2);
        $C2 = pow($n_terbobot->m_normalisasi_terbobotC2 - $dt_solusi_ideal_positif_negatif[1]->solusiNegatif, 2);
        $C3 = pow($n_terbobot->m_normalisasi_terbobotC3 - $dt_solusi_ideal_positif_negatif[2]->solusiNegatif, 2);
        $C4 = pow($n_terbobot->m_normalisasi_terbobotC4 - $dt_solusi_ideal_positif_negatif[3]->solusiNegatif, 2);
        $C5 = pow($n_terbobot->m_normalisasi_terbobotC5 - $dt_solusi_ideal_positif_negatif[4]->solusiNegatif, 2);
        $C6 = pow($n_terbobot->m_normalisasi_terbobotC6 - $dt_solusi_ideal_positif_negatif[5]->solusiNegatif, 2);

        $SQRT_negatif = sqrt( $C1 + $C2 + $C3 + $C4 + $C5 + $C6);

        return array(

            'positif' => $SQRT_positif,
            'negatif' => $SQRT_negatif
        );
    }

    public function destroy($id)
    {
        Topsis::find($id)->delete();
        return redirect('topsis');
    }

    public function cetak_pdf(Request $request){
        $periode = Periode::where('id_periode', $request->id_periode)->first();
        $topsis = DB::table("topsis")
                ->select("topsis.*", "periode.*")
                ->join("periode", "periode.id_periode", "=", "topsis.id_periode");
        $pdf = PDF::loadview('perhitungan.cetak_pdf',['topsis'=>$topsis,'periode'=>$periode]);
        return $pdf->stream();
    }
}
