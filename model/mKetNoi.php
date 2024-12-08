<?php
    class mKetNoi{
        public function moKetNoi(){
            return mysqli_connect("localhost","root", "", "dbquanlysanbong");
        }

        public function dongKetNoi($con){
            mysqli_close($con);
        }
    }
?>