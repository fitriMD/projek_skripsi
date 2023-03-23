<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AhpController extends Controller
{

    public function index() {

        $ahp = DB::table("ahp")->get();
        return view('perhitungan.ahp', compact('ahp'));
    }


    // rest ahp
    public function reset() {

        DB::table("ahp")->truncate();

        return redirect('ahp');
    }

    // perhitungan AHP
    public function main() {

        // Tahapan perhitungan AHP

        // A. Matrix berpasangan kriteria
        $matrix = $this->matrix_berpasangan_kriteria();

        // B. Hasil penjumlahan kolom
        $matrix_hasil_penjumlahan = $this->matrix_penjumlahan_kolom( $matrix );
        // var_dump( $matrix_hasil_penjumlahan );
        
        // C. Normalisasi Matrix
        $matrix_normalisasi = $this->matrix_normalisasi( $matrix, $matrix_hasil_penjumlahan );

        // D. Penentuan Bobot
        $matrix_bobot = $this->matrix_pembobotan($matrix_normalisasi);


        // simpan di db
        $matrix_perbandingan= array(

            'm'    => $matrix, 
            'm_hasil_penjumlahan' => $matrix_hasil_penjumlahan,
            'm_normalisasi'       => $matrix_normalisasi,
        );

        $json_matrix_perbandingan = json_encode( $matrix_perbandingan );
        $json_matrix_bobot = json_encode( $matrix_bobot );

        $dt_insert = array(

            'matrix_perbandingan'   => $json_matrix_perbandingan,
            'bobot_prioritas'       => $json_matrix_bobot
        );

        DB::table("ahp")->insert( $dt_insert );

        return redirect('ahp');
    }


    // A. Matrix Berpasangan Kriteria
    function matrix_berpasangan_kriteria() {

        // nilai
        $matrix = array(

            [1, 3, 9, 3, 3, 2],
            [0.33, 1, 3, 2, 2, 0.2],
            [0.11, 0.33, 1, 0.33, 0.33, 0.2],
            [0.33, 0.5, 3, 1, 2, 0.33],
            [0.33, 0.5, 3, 0.5, 1, 0.2],
            [0.5, 5, 5, 3, 5, 1]
        );

        // metode matrix array
        // $matrix[0][0] = 1;
        // $matrix[0][1] = 3;
        

        return $matrix;


        
    }


    // B. Matrix Hasil penjumlahan kolom
    function matrix_penjumlahan_kolom( $matrix ){

        // foreach ( $matrix AS $baris => $isi ) {

        //     // inisialisasi variabel
        //     echo "<h1>Data C".$baris."</h1>";
        //     $total = 0;
        //     foreach ( $isi AS $kolom => $nilai ) {

        //         echo "C". $baris."C".$kolom." : ".$nilai." <br>";

        //         $total = $total + $nilai;

        //         // iterasi 1 
        //         // total = 0 
        //         // nilai = 1 
        //         // total = total + nilai 
        //         // total = 0 + 1 
        //         // total = 1


        //         // // iterasi 2 
        //         // total = 1 
        //         // nilai = 3
        //         // total = total + nilai 
        //         // total = 1 + 3 
        //         // total = 4


        //         // // iterasi 3 
        //         // total = total + nilai 
        //         // total = 4 + 9 
        //         // total = 13 

        //         // // iterasi 4 
        //         // total = 13 + 3 
        //         // total = 16

        //         // // iterasi 5 
        //         // total = 19 

        //         // // iterasi 6
        //         // total = 21
        //     }


        //     echo "<h3>".$total."</h3>";
        // }


        $jumlah = count( $matrix );
        $total_keseluruhan = array();

        for ( $kolom = 0; $kolom < $jumlah; $kolom++ ) {

            // echo "<h1>C".($kolom + 1)."</h1>";
            $total = 0;
            for ( $baris = 0; $baris < $jumlah; $baris++ ) {

                // echo "kolom ". $kolom.' baris '. $baris;
                // echo "<br>";
                $nilai = $matrix[$baris][$kolom];
                // echo $nilai ."<br>";

                $total = $total + $nilai;
            }

            array_push( $total_keseluruhan, $total );

            // echo "<h3>".$total."</h3>";
            
        }


        return $total_keseluruhan;


        
    }


    // C. Normalisasi Matrix
    function matrix_normalisasi( $matrix, $matrix_hasil_penjumlahan ) {

        $jumlah = count( $matrix );
        $matrix_normalisasi = array();

        for ( $kolom = 0; $kolom < $jumlah; $kolom++ ) {

            // echo "<h1>C".($kolom + 1)."</h1>";
            
            for ( $baris = 0; $baris < $jumlah; $baris++ ) {
                
                $na = 0;
                $nilai = $matrix[$baris][$kolom];
                $pembagi = $matrix_hasil_penjumlahan[ $kolom ];
                
                $hs_akhir = 0;
                if ( $nilai != 0 && $pembagi != 0 ) {

                    $hs_akhir = number_format($nilai / $pembagi, 2);
                }
                // echo $hs_akhir;
                // echo "<br>";

                $matrix_normalisasi[$baris][$kolom] = $hs_akhir;
            }

            // echo '<h4>'.$total.'</h4>';
        }

        
        // echo json_encode( $matrix_normalisasi );
        return $matrix_normalisasi;
    }


    // D. Penentuan Bobot
    function matrix_pembobotan( $matrix_normalisasi ){

        // echo json_encode( $matrix_normalisasi );
        $jumlah = count( $matrix_normalisasi );
        $matrix_pembobotan = array();

        for ( $baris = 0; $baris < $jumlah; $baris++ ) {

            // echo "<h1>Data C".$baris."</h1>";
            $total = 0;
            for ( $kolom = 0; $kolom < $jumlah; $kolom++ ) {

                $nilai = $matrix_normalisasi[$baris][$kolom];
                // echo $nilai.'<br>';

                $total = $total + $nilai;
            }

            // echo "<h4>".$total / $jumlah."</h4>";
            $matrix_pembobotan[$baris] = $total / $jumlah;
        }

        return $matrix_pembobotan;
    }

    




}
