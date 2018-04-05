<?php
require_once __DIR__ . "/../vendor/autoload.php";

function test($str, $actual){
    $bus = new Bus\Bus();
    $kekka = $bus->parseAndCalc($str);
    if ((string)$kekka !== $actual) {
        throw new LogicException('仕様通りの実装ではありません。計算結果 -> ' . $kekka . ' : 本当の値 -> '. $actual);
    }
}

/*0*/ test( "210:Cn,In,Iw,Ap,Iw", "170" );
/*1*/ test( "220:Cp,In", "110" );
/*2*/ test( "230:Cw,In,Iw", "240" );
/*3*/ test( "240:In,An,In", "240" );
/*4*/ test( "250:In,In,Aw,In", "260" );
/*5*/ test( "260:In,In,In,In,Ap", "260" );
/*6*/ test( "270:In,An,In,In,Ip", "410" );
/*7*/ test( "280:Aw,In,Iw,In", "210" );
/*8*/ test( "200:An", "200" );
/*9*/ test( "210:Iw", "60" );
/*10*/ test( "220:Ap", "0" );
/*11*/ test( "230:Cp", "0" );
/*12*/ test( "240:Cw", "60" );
/*13*/ test( "250:In", "130" );
/*14*/ test( "260:Cn", "130" );
/*15*/ test( "270:Ip", "0" );
/*16*/ test( "280:Aw", "140" );
/*17*/ test( "1480:In,An,In,In,In,Iw,Cp,Cw,In,Aw,In,In,Iw,Cn,Aw,Iw", "5920" );
/*18*/ test( "630:Aw,Cw,Iw,An,An", "1740" );
/*19*/ test( "340:Cn,Cn,Ip,Ap", "340" );
/*20*/ test( "240:Iw,Ap,In,Iw,Aw", "120" );
/*21*/ test( "800:Cw,An,Cn,Aw,Ap", "1800" );
/*22*/ test( "1210:An,Ip,In,Iw,An,Iw,Iw,An,Iw,Iw", "3630" );
/*23*/ test( "530:An,Cw,Cw", "810" );
/*24*/ test( "170:Aw,Iw,Ip", "90" );
/*25*/ test( "150:In,Ip,Ip,Iw,In,Iw,Iw,In,An,Iw,Aw,Cw,Iw,Cw,An,Cp,Iw", "580" );
/*26*/ test( "420:Cn,Cw,Cp", "320" );
/*27*/ test( "690:Cw,In,An,Cp,Cn,In", "1220" );
/*28*/ test( "590:Iw,Iw,Cn,Iw,Aw,In,In,Ip,Iw,Ip,Aw", "1200" );
/*29*/ test( "790:Cw,Cn,Cn", "1000" );
/*30*/ test( "1220:In,In,An,An,In,Iw,Iw,In,In,Ip,In,An,Iw", "4590" );
/*31*/ test( "570:Cw,Cn,Cp", "440" );
/*32*/ test( "310:Cn,Cw,An,An,Iw,Cp,Cw,Cn,Iw", "1100" );
/*33*/ test( "910:Aw,In,Iw,Iw,Iw,Iw,Iw,An,Cw,In", "2290" );
/*34*/ test( "460:Iw,Cw,Cw,Cn", "590" );
/*35*/ test( "240:Iw,Iw,In,Iw,In,In,Cn,In,An", "780" );
/*36*/ test( "1240:In,In,In,Ap,In,Cw,Iw,Iw,Iw,Aw,Cw", "2170" );
/*37*/ test( "1000:Iw,Ip,In,An,In,In,In,An,In,Iw,In,In,Iw,In,Iw,Iw,Iw,An", "5500" );
/*38*/ test( "180:In,Aw,Ip,Iw,In,Aw,In,Iw,Iw,In", "330" );
/*39*/ test( "440:In,Ip,Cp,Aw,Iw,In,An", "660" );
/*40*/ test( "1270:Ap,In,An,Ip,In,Ip,Ip", "1270" );