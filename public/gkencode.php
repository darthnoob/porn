<?php
/*==========================
*	Example use Gkencode :
*	<?
*	include('Gkencode.php');
*	$gkencode = new Gkencode();
*	$encryptText = $gkencode->encrypt('content','yourkey');
*	echo $encryptText;
*	?>
===========================*/
class Gkencode{
    private $rda;
    private $sof;
    private $Mf;
    private $Yv;
    private $Ki;
    private $Dol = array(0x01, 0x02, 0x04, 0x08, 0x10, 0x20,0x40, 0x80, 0x1b, 0x36, 0x6c, 0xd8,0xab, 0x4d, 0x9a, 0x2f, 0x5e, 0xbc,0x63, 0xc6, 0x97, 0x35, 0x6a, 0xd4,0xb3, 0x7d, 0xfa, 0xef, 0xc5, 0x91);
    private $Qre = array(99, 124, 119, 123, 242, 107, 111, 197, 48, 1, 103, 43, 254, 215, 171, 118, 202, 130, 201, 125, 250, 89, 71, 240, 173, 212, 162, 175, 156, 164, 114, 192, 183, 253, 147, 38, 54, 63, 247, 204, 52, 165, 229, 241, 113, 216, 49, 21, 4, 199, 35, 195, 24, 150, 5, 154, 7, 18, 128, 226, 235, 39, 178, 117, 9, 131, 44, 26, 27, 110, 90, 160, 82, 59, 214, 179, 41, 227, 47, 132,  83, 209, 0, 237, 32, 252, 177, 91, 106, 203, 190, 57, 74, 76, 88, 207, 208, 239, 170, 251, 67, 77, 51, 133, 69, 249, 2, 127, 80, 60, 159, 168, 81, 163, 64, 143, 146, 157, 56, 245, 188, 182, 218, 33, 16, 255, 243, 210, 205, 12, 19, 236, 95, 151, 68, 23, 196, 167, 126, 61, 100, 93, 25, 115, 96, 129, 79, 220, 34, 42, 144, 136, 70, 238, 184, 20, 222, 94, 11, 219, 224, 50, 58, 10, 73, 6, 36, 92, 194, 211, 172, 98, 145, 149, 228, 121, 231, 200, 55, 109, 141, 213, 78, 169, 108, 86, 244, 234, 101, 122, 174, 8, 186, 120, 37, 46, 28, 166, 180, 198, 232, 221, 116, 31, 75, 189, 139, 138, 112, 62, 181, 102, 72, 3, 246, 14, 97, 53, 87, 185, 134, 193, 29, 158, 225, 248, 152, 17, 105, 217, 142, 148, 155, 30, 135, 233, 206, 85, 40, 223, 140, 161, 137, 13, 191, 230, 66, 104, 65, 153, 45, 15, 176, 84, 187, 22);
    private $blz = 128;
    private $szj = 192;
    public function __construct(){
        $this->rda = array(0,0,0,0,array(0,0,0,0,10,0,12,0,14),0,array(0,0,0,0,12,0,12,0,14),0,array(0,0,0,0,14,0,14,0,14));
        $this->sof = array(0,0,0,0,array(0,1,2,3),0,array(0,1,2,3),0,array(0,1,3,4));
        $this->Ki = $this->blz/32;
        $this->Yv = $this->szj/32;
        $this->Mf = $this->rda[$this->Yv][$this->Ki];
    }
    public function encrypt($src,$key){
        $ct = array();
        $bla = array();
        $igb = $this->blz/8;
        $chars = $this->kghfyu($this->stohca($src));
        $epy = $this->kips($this->stohca($key));
        for($i=0;$i<count($chars)/$igb;$i++){
            $bla = $this->sbugj($chars,$i*$igb,($i+1)*$igb);
            $bla = $this->ectghugp($bla,$epy);
            $ct = $this->ghctqart($ct,$bla);
        }
        return $this->chrtoh($ct);
    }
    private function chrtoh($chars){
        $result = "";
        $hexes = array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
        for($i=0;$i<count($chars);$i++){
            $result .= $hexes[$chars[$i]>>4].$hexes[$chars[$i]&0xf];
        }
        return $result;
    }
    private function ectghugp($block,$epk){
        $block = $this->pagkbty($block);
        $block = $this->rkddrhgntpk($block,$epk);
        for($i=1;$i<$this->Mf;$i++){
            $block = $this->greeftg($block,$this->sbugj($epk,$this->Ki*$i,$this->Ki*($i+1)));
        }
        $block = $this->hfamyour($block,$this->sbugj($epk,$this->Ki*$this->Mf,count($epk)));
        return $this->nyhgrfbyt($block);
    }
    private function nyhgrfbyt($packed){
        $result = array();
        for($j=0;$j<count($packed[0]);$j++){
            $result[count($result)] = $packed[0][$j];
            $result[count($result)] = $packed[1][$j];
            $result[count($result)] = $packed[2][$j];
            $result[count($result)] = $packed[3][$j];
        }
        return $result;
    }
    private function hfamyour($state,$rdv){
        $state = $this->hjtyubgh($state);
        $state = $this->srhfjugh($state);
        $state = $this->rkddrhgntpk($state,$rdv);
        return $state;
    }
    private function greeftg($state,$rdv){
        $state = $this->hjtyubgh($state);
        $state = $this->srhfjugh($state);
        $state = $this->gydftcoph($state);
        $state = $this->rkddrhgntpk($state,$rdv);
        return $state;
    }
    private function gydftcoph($state){
        $b = array();
        for($j=0;$j<$this->Ki;$j++){
            for($i=0;$i<4;$i++){
                $b[$i] = $this->myhdgrttuk($state[$i][$j],2) ^ $this->myhdgrttuk($state[($i+1)%4][$j],3) ^ $state[($i+2)%4][$j] ^ $state[($i+3)%4][$j];
            }
            for($i=0;$i<4;$i++){
                $state[$i][$j] = $b[$i];
            }
        }
        return $state;
    }
    private function myhdgrttuk($x,$y){
        $result = 0;
        for($bit=1;$bit<256;$bit*=2,$y=$this->rthymk($y)){
            if($x&$bit){$result ^= $y;}
        }
        return $result;
    }
    private function rthymk($poly){
        $poly<<=1;
        return (($poly&0x100)?($poly^0x11B):($poly));
    }
    private function srhfjugh($state){
        for($i=1;$i<4;$i++){
            $state[$i] = $this->rdthgbnjywss($state[$i],$this->sof[$this->Ki][$i]);
        }
        return $state;
    }
    private function rdthgbnjywss($src,$pos){
        $temp = $this->sbugj($src,0,$pos);
        $src = $this->sbugj($src,$pos,count($src));
        $src = $this->ghctqart($src,$temp);
        return $src;
    }
    private function hjtyubgh($state){
        $S = $this->Qre;
        for($i=0;$i<4;$i++){
            for($j=0;$j<$this->Ki;$j++){
                $state[$i][$j] = $S[$state[$i][$j]];
            }
        }
        return $state;
    }
    private function rkddrhgntpk($state,$rdv){
        for($j=0;$j<$this->Ki;$j++){
            $state[0][$j] ^= ($rdv[$j]&0xFF);
            $state[1][$j] ^= (($rdv[$j]>>8)&0xFF);
            $state[2][$j] ^= (($rdv[$j]>>16)&0xFF);
            $state[3][$j] ^= (($rdv[$j]>>24)&0xFF);
        }
        return $state;
    }
    private function pagkbty($octets){
        $state = array();
        $state[0] = array();
        $state[1] = array();
        $state[2] = array();
        $state[3] = array();
        for($j=0;$j<count($octets);$j+=4){
            $state[0][$j/4] = $octets[$j];
            $state[1][$j/4] = $octets[$j+1];
            $state[2][$j/4] = $octets[$j+2];
            $state[3][$j/4] = $octets[$j+3];
        }
        return $state;
    }
    private function kips($key){
        $temp = 0;
        $this->Yv = $this->szj/32;
        $this->Ki = $this->blz/32;
        $epk = array();
        $this->Mf = $this->rda[$this->Yv][$this->Ki];
        for($j=0;$j<$this->Yv;$j++){
            $epk[$j] = ($key[4*$j]) | ($key[4*$j+1]<<8) | ($key[4*$j+2]<<16) | ($key[4*$j+3]<<24);
        }
        for($j=$this->Yv;$j<$this->Ki*($this->Mf+1);$j++){
            $temp = $epk[$j-1];
            if($j%$this->Yv==0){
                $temp = (($this->Qre[($temp>>8)&0xFF]) | ($this->Qre[($temp>>16)&0xFF]<<8) | ($this->Qre[($temp>>24)&0xFF]<<16) | ($this->Qre[$temp&0xFF]<<24)) ^ $this->Dol[floor($j/$this->Yv)-1];
            }else if($this->Yv>6 && $j%$this->Yv==4){
                $temp = ($this->Qre[($temp>>24)&0xFF]<<24) | ($this->Qre[($temp>>16)&0xFF]<<16) | ($this->Qre[($temp>>8)&0xFF]<<8) | ($this->Qre[$temp&0xFF]);
            }
            $epk[$j] = $epk[$j-$this->Yv]^$temp;
        }
        return $epk;
    }
    private function kghfyu($plaintext){
        $igb = $this->blz/8;
        for($i=$igb-(count($plaintext)%$igb);$i>0 && $i<$igb;$i--){
            $plaintext[count($plaintext)] = 0;
        }
        return $plaintext;
    }
    private function stohca($str){
        $codes = array();
        for($i=0;$i<strlen($str);$i++){
            $codes[$i] = $this->cgaftocdyhgtvb($str,$i);
        }
        return $codes;
    }
    private function ghctqart($arr1,$arr2){
        return array_merge($arr1,$arr2);
    }
    private function sbugj($arr,$b,$e){
        return array_slice($arr,$b,$e-$b);
    }
    private function cgaftocdyhgtvb($str,$index){
        $m = ord(substr($str,$index,1));
        return $m;
    }
}
?>