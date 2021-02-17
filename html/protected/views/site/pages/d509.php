<pre>
<?php
$text = '\uF1B6\u552C\u9C46\u8FDA\u6F1C\uCFDF\u90FA\u4827\u7A30\u8B6C\u110E';
$text = '\\uF1A4\u553C\u9C40\u8FC4\u6F09\uCFC1\u90FB\u482F\u7A32\u8B67\u1148';
//$text = '\uF18C\u5514\u9C5B\u8FDC\u6F09\uCFD0\u90FD\u4821\u7A3F\u8B76\u1106\uB3C6\u57D7\u99FD\u8761\uD31D\uAF3E\u5D81\u1FB9\u7B57\u58EF\uA8BD\u8837\u6657\u835D\u65BD\u5F35\uE9F9\uCFF6\u2370\u9F2F\u7302\uF017\u3073';
echo CHtml::tag('h1',array(),$text);

function d509($s) { // злая функция дешифровки
_L10:
	echo '_L10 k4!=0'.PHP_EOL;
	if($k4 != 0) goto _L2; else goto _L1;
_L1:
	$k4++;
	$j1 = mb_strlen($s);
    $k1 = 0;
   echo '_L8 k1='.$k1.' j1='.$j1.PHP_EOL;
_L8:
	echo '_L1 k4='.$k4.' j1='.$j1.PHP_EOL;
	if($k1 >= $j1) goto _L4; else goto _L3;
_L9:
	var_dump($flag1);
	if($flag1) goto _L6; else goto _L5;
_L5:
        $flag1 = true;
        switch($k1 % 8) {
	        case 0: // '\0'
    	        $s[$k1] = ($k >> 16 ^ $s[$k1]);
        	break;

	        case 1: // '\001'
    	        $s[$k1] = ($k ^ $s[$k1]);
            break;

	        case 2: // '\002'
	            $s[$k1] = ($l >> 16 ^ $s[$k1]);
            break;

	        case 3: // '\003'
	            $s[$k1] = ($l ^ $s[$k1]);
            break;

	        case 4: // '\004'
	            $s[$k1] = ($i1 >> 16 ^ $s[$k1]);
            break;

	        case 5: // '\005'
	            $s[$k1] = ($i1 ^ $s[$k1]);
            break;

	        case 6: // '\006'
	            $s[$k1] = ($j >> 16 ^ $s[$k1]);
            break;

	        case 7: // '\007'
	            $s[$k1] = ($j ^ $s[$k1]);
            break;
        }
      	goto _L7;
_L6:
	 //obj; ???
_L7:
	$k1++;
    goto _L8;
_L2:
	// obj1; ???
_L4:
	return $s;
_L3:
	//Object obj; ???
 	//Object obj1; ???
  	$flag1 = false;
    if($k1 % 8 == 0) {    	$l1 = 0;
    	$i2 = $k ^ $ai[0];
    	$j2 = $l ^ $ai[1];
    	$k2 = $i1 ^ $ai[2];
    	$l2 = $j ^ $ai[3];
    	for($l1 = 4; $l1 < 36; $l1 += 4) {
            $i3 = $ai2[$i2 & 0xff] ^ $ai3[$j2 >> 8 & 0xff] ^ $ai4[$k2 >> 16 & 0xff] ^ $ai5[$l2 >> 24] ^ $ai[$l1];
            $k3 = $ai2[$j2 & 0xff] ^ $ai3[$k2 >> 8 & 0xff] ^ $ai4[$l2 >> 16 & 0xff] ^ $ai5[$i2 >> 24] ^ $ai[$l1 + 1];
            $i4 = $ai2[$k2 & 0xff] ^ $ai3[l2 >> 8 & 0xff] ^ $ai4[i2 >> 16 & 0xff] ^ $ai5[$j2 >> 24] ^ $ai[$l1 + 2];
            $l2 = $ai2[$l2 & 0xff] ^ $ai3[i2 >> 8 & 0xff] ^ $ai4[j2 >> 16 & 0xff] ^ $ai5[k2 >> 24] ^ $ai[$l1 + 3];
            $l1 += 4;
            $i2 = $ai2[$i3 & 0xff] ^ $ai3[$k3 >> 8 & 0xff] ^ $ai4[$i4 >> 16 & 0xff] ^ $ai5[$l2 >> 24] ^ $ai[$l1];
            $j2 = $ai2[$k3 & 0xff] ^ $ai3[$i4 >> 8 & 0xff] ^ $ai4[$l2 >> 16 & 0xff] ^ $ai5[$i3 >> 24] ^ $ai[$l1 + 1];
            $k2 = $ai2[$i4 & 0xff] ^ $ai3[$l2 >> 8 & 0xff] ^ $ai4[$i3 >> 16 & 0xff] ^ $ai5[$k3 >> 24] ^ $ai[$l1 + 2];
            $l2 = $ai2[$l2 & 0xff] ^ $ai3[$i3 >> 8 & 0xff] ^ $ai4[$k3 >> 16 & 0xff] ^ $ai5[i4 >> 24] ^ $ai[$l1 + 3];
        }

		$j4 = $ai2[$i2 & 0xff] ^ $ai3[$j2 >> 8 & 0xff] ^ $ai4[$k2 >> 16 & 0xff] ^ $ai5[$l2 >> 24] ^ $ai[$l1];
  		$l3 = $ai2[$j2 & 0xff] ^ $ai3[$k2 >> 8 & 0xff] ^ $ai4[$l2 >> 16 & 0xff] ^ $ai5[$i2 >> 24] ^ $ai[$l1 + 1];
        $j3 = $ai2[$k2 & 0xff] ^ $ai3[$l2 >> 8 & 0xff] ^ $ai4[$i2 >> 16 & 0xff] ^ $ai5[$j2 >> 24] ^ $ai[$l1 + 2];
        $l2 = $ai2[$l2 & 0xff] ^ $ai3[$i2 >> 8 & 0xff] ^ $ai4[$j2 >> 16 & 0xff] ^ $ai5[k2 >> 24] ^ $ai[$l1 + 3];
        $k2 = $l1 + 4;

        $k = $abyte0[$j4 & 0xff] & 0xff ^ ($abyte0[$l3 >> 8 & 0xff] & 0xff) << 8 ^ ($abyte0[$j3 >> 16 & 0xff] & 0xff) << 16 ^ $abyte0[$l2 >> 24] << 24 ^ $ai[$k2 + 0];
        $l = $abyte0[$l3 & 0xff] & 0xff ^ ($abyte0[$j3 >> 8 & 0xff] & 0xff) << 8 ^ ($abyte0[$l2 >> 16 & 0xff] & 0xff) << 16 ^ $abyte0[$j4 >> 24] << 24 ^ $ai[$k2 + 1];
    	$i1 = $abyte0[$j3 & 0xff] & 0xff ^ ($abyte0[$l2 >> 8 & 0xff] & 0xff) << 8 ^ ($abyte0[$j4 >> 16 & 0xff] & 0xff) << 16 ^ $abyte0[$l3 >> 24] << 24 ^ $ai[$k2 + 2];
     	$j = $abyte0[$l2 & 0xff] & 0xff ^ ($abyte0[$j4 >> 8 & 0xff] & 0xff) << 8 ^ ($abyte0[$l3 >> 16 & 0xff] & 0xff) << 16 ^ $abyte0[j3 >> 24] << 24 ^ $ai[$k2 + 3];    }
    $flag1 = false;
    null;
    goto _L9;
//    die("_mth1D5B()");
    $flag = false;
    $k4 = 0;
    if($_fld8F03 == null) {
    	die("_mth1D5B()");
    }

       /*
        astacktraceelement = Thread.currentThread().getStackTrace();
        StringBuilder stringbuilder = JVM INSTR new #71  <Class StringBuilder>;
        stringbuilder.StringBuilder();
        String s1 = astacktraceelement[2].getClassName();
        stringbuilder = stringbuilder.append(s1);
        s1 = astacktraceelement[2].getMethodName();
        int i = stringbuilder.append(s1).toString().hashCode();
        int ai1[] = (int[])(int[])_fld8F03[6];
        int k = i ^ ai1[0];
        int l = i ^ ai1[1];
        int i1 = i ^ ai1[2];
        int j = i ^ ai1[3];
        int ai[] = (int[])(int[])_fld8F03[5];
        int ai2[] = (int[])(int[])_fld8F03[1];
        int ai3[] = (int[])(int[])_fld8F03[2];
        int ai4[] = (int[])(int[])_fld8F03[3];
        int ai5[] = (int[])(int[])_fld8F03[4];
        byte abyte0[] = (byte[])(byte[])_fld8F03[0];
        int j1;
        int k1;
        s = s.toCharArray();
        k4 = 0;
        null;  */
          goto _L10;}


echo ']'.d509($text).'[';

?>

static final String D509(String s)
    {
_L10:
        if(k4 != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        k4++;
        j1 = s.length;
        k1 = 0;
_L8:
        if(k1 >= j1) goto _L4; else goto _L3
_L9:
        if(flag1) goto _L6; else goto _L5
_L5:
        JVM INSTR pop ;
        flag1 = true;
        switch(k1 % 8)
        {
        case 0: // '\0'
            s[k1] = (char)(k >> 16 ^ s[k1]);
            break;

        case 1: // '\001'
            s[k1] = (char)(k ^ s[k1]);
            break;

        case 2: // '\002'
            s[k1] = (char)(l >> 16 ^ s[k1]);
            break;

        case 3: // '\003'
            s[k1] = (char)(l ^ s[k1]);
            break;

        case 4: // '\004'
            s[k1] = (char)(i1 >> 16 ^ s[k1]);
            break;

        case 5: // '\005'
            s[k1] = (char)(i1 ^ s[k1]);
            break;

        case 6: // '\006'
            s[k1] = (char)(j >> 16 ^ s[k1]);
            break;

        case 7: // '\007'
            s[k1] = (char)(j ^ s[k1]);
            break;
        }
          goto _L7
_L6:
        obj;
_L7:
        k1++;
          goto _L8
_L2:
        obj1;
_L4:
        return new String(s);
_L3:
        Object obj;
        Object obj1;
        boolean flag1;
        if(k1 % 8 == 0)
        {
            int l1 = 0;
            l1 = 0;
            l1 = 0;
            l1 = 0;
            int i2 = k ^ ai[0];
            int j2 = l ^ ai[1];
            int k2 = i1 ^ ai[2];
            int l2 = j ^ ai[3];
            for(l1 = 4; l1 < 36; l1 += 4)
            {
                int i3 = ai2[i2 & 0xff] ^ ai3[j2 >> 8 & 0xff] ^ ai4[k2 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
                int k3 = ai2[j2 & 0xff] ^ ai3[k2 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i2 >>> 24] ^ ai[l1 + 1];
                int i4 = ai2[k2 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i2 >> 16 & 0xff] ^ ai5[j2 >>> 24] ^ ai[l1 + 2];
                l2 = ai2[l2 & 0xff] ^ ai3[i2 >> 8 & 0xff] ^ ai4[j2 >> 16 & 0xff] ^ ai5[k2 >>> 24] ^ ai[l1 + 3];
                l1 += 4;
                i2 = ai2[i3 & 0xff] ^ ai3[k3 >> 8 & 0xff] ^ ai4[i4 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
                j2 = ai2[k3 & 0xff] ^ ai3[i4 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i3 >>> 24] ^ ai[l1 + 1];
                k2 = ai2[i4 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i3 >> 16 & 0xff] ^ ai5[k3 >>> 24] ^ ai[l1 + 2];
                l2 = ai2[l2 & 0xff] ^ ai3[i3 >> 8 & 0xff] ^ ai4[k3 >> 16 & 0xff] ^ ai5[i4 >>> 24] ^ ai[l1 + 3];
            }

            int j4 = ai2[i2 & 0xff] ^ ai3[j2 >> 8 & 0xff] ^ ai4[k2 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
            int l3 = ai2[j2 & 0xff] ^ ai3[k2 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i2 >>> 24] ^ ai[l1 + 1];
            int j3 = ai2[k2 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i2 >> 16 & 0xff] ^ ai5[j2 >>> 24] ^ ai[l1 + 2];
            l2 = ai2[l2 & 0xff] ^ ai3[i2 >> 8 & 0xff] ^ ai4[j2 >> 16 & 0xff] ^ ai5[k2 >>> 24] ^ ai[l1 + 3];
            k2 = l1 + 4;
            k = abyte0[j4 & 0xff] & 0xff ^ (abyte0[l3 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[j3 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[l2 >>> 24] << 24 ^ ai[k2 + 0];
            l = abyte0[l3 & 0xff] & 0xff ^ (abyte0[j3 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[l2 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[j4 >>> 24] << 24 ^ ai[k2 + 1];
            i1 = abyte0[j3 & 0xff] & 0xff ^ (abyte0[l2 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[j4 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[l3 >>> 24] << 24 ^ ai[k2 + 2];
            j = abyte0[l2 & 0xff] & 0xff ^ (abyte0[j4 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[l3 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[j3 >>> 24] << 24 ^ ai[k2 + 3];
        }

        flag1 = false;
        null;
          goto _L9
        boolean flag = false;
        int k4 = 0;
        if(_fld8F03 == null)
            _mth1D5B();
        astacktraceelement = Thread.currentThread().getStackTrace();
        StringBuilder stringbuilder = JVM INSTR new #71  <Class StringBuilder>;
        stringbuilder.StringBuilder();
        String s1 = astacktraceelement[2].getClassName();
        stringbuilder = stringbuilder.append(s1);
        s1 = astacktraceelement[2].getMethodName();
        int i = stringbuilder.append(s1).toString().hashCode();
        int ai1[] = (int[])(int[])_fld8F03[6];
        int k = i ^ ai1[0];
        int l = i ^ ai1[1];
        int i1 = i ^ ai1[2];
        int j = i ^ ai1[3];
        int ai[] = (int[])(int[])_fld8F03[5];
        int ai2[] = (int[])(int[])_fld8F03[1];
        int ai3[] = (int[])(int[])_fld8F03[2];
        int ai4[] = (int[])(int[])_fld8F03[3];
        int ai5[] = (int[])(int[])_fld8F03[4];
        byte abyte0[] = (byte[])(byte[])_fld8F03[0];
        int j1;
        int k1;
        s = s.toCharArray();
        k4 = 0;
        null;
          goto _L10
    }
</pre>
<?php

/*

// Decompiled by DJ v3.12.12.100 Copyright 2015 Atanas Neshkov  Date: 10.11.2015 23:34:51
// Home Page:  http://www.neshkov.com/dj.html - Check often for new version!
// Decompiler options: packimports(3)

package minecraftsocial.authplugin;


public class c$a$1
{

    private static final int _mth76FB(int i, int j)
    {
_L7:
        if(j1 != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        j1 = 3;
        l = i >>> j | i << -j;
          goto _L3
_L2:
        j;
          goto _L4
_L8:
        if(j1 != 0) goto _L6; else goto _L5
_L5:
        JVM INSTR pop ;
        j1++;
        l = k + i1;
          goto _L3
_L6:
        obj;
_L3:
        return l;
        j1 = 0;
        int k = i;
        int l = j;
        Object obj;
        int i1 = l + k >> 24;
        j1 = 0;
        null;
          goto _L7
_L4:
        j1 = 0;
        null;
          goto _L8
    }

    private static final int BC76(byte abyte0[], int i)
    {
_L7:
        if(byte0 != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        byte0 = 3;
        j = abyte0[i & 0xff] & 0xff | (abyte0[i >> 8 & 0xff] & 0xff) << 8 | (abyte0[i >> 16 & 0xff] & 0xff) << 16 | abyte0[i >> 24 & 0xff] << 24;
          goto _L3
_L2:
        obj;
          goto _L4
_L8:
        if(byte0 != 0) goto _L6; else goto _L5
_L5:
        JVM INSTR pop ;
        byte0 = 2;
        j = abyte0[i & 0x7f] >> 8;
          goto _L3
_L6:
        obj;
_L3:
        return j;
        byte0 = 0;
        Object obj;
        int j = abyte0[14] << 16;
        byte0 = 0;
        null;
          goto _L7
_L4:
        byte0 = 0;
        null;
          goto _L8
    }

    private static final byte[] _mth5D2A(long l)
    {
        return (new byte[] {
            (byte)(int)(l >> 56 & 255L), (byte)(int)(l >> 48 & 255L), (byte)(int)(l >> 40 & 255L), (byte)(int)(l >> 32 & 255L), (byte)(int)(l >> 24 & 255L), (byte)(int)(l >> 16 & 255L), (byte)(int)(l >> 8 & 255L), (byte)(int)(l & 255L)
        });
    }

    private static final long _mth8E11(long l)
    {
_L7:
        if(i != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        i = 1;
        l2 = l1 + l + l2 >> 24;
          goto _L3
_L2:
        obj;
          goto _L4
_L8:
        if(i != 0) goto _L6; else goto _L5
_L5:
        JVM INSTR pop ;
        i++;
        l1 = l + l2;
          goto _L3
_L6:
        obj;
_L3:
        return l1;
        i = 0;
        l = l;
        long l1 = 0x7d3616c970637766L;
        Object obj;
        long l2 = l1 + l >> 24;
        i = 0;
        null;
          goto _L7
_L4:
        i = 0;
        null;
          goto _L8
    }

    private static final long _mth38B5()
    {
        return 0x63c6da171dee95f7L;
    }

    private static final void _mth1D5B()
    {
_L12:
        if(byte0 != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        byte0 = 1;
        for(k = 0; k < 255; k++)
        {
            j = ai[255 - k] | ai[255 - k] << 8;
            abyte0[ai[k]] = (byte)(j ^ (j >> 4 ^ j >> 5 ^ j >> 6 ^ j >> 7) ^ 0x63);
        }

        for(j = 0; j < 256; j++)
        {
            int j1 = abyte0[j] & 0xff;
            j1 = ((j1 ^ (k = j1 << 1 ^ (j1 >>> 7) * 283)) << 24 ^ j1 << 16 ^ j1 << 8 ^ k) & -1;
            ai1[j] = j1;
            ai2[j] = j1 << 8 | j1 >>> -8;
            ai3[j] = j1 << 16 | j1 >>> -16;
            ai4[j] = j1 << 24 | j1 >>> -24;
        }

        int k1 = 0;
        k = 1;
        for(; k1 < 30; k1++)
        {
            ai5[k1] = k;
            k = k << 1 ^ (k >>> 7) * 283;
        }

          goto _L3
_L2:
        abyte1;
          goto _L3
_L13:
        if(byte0 != 0)
            break MISSING_BLOCK_LABEL_461;
        JVM INSTR pop ;
        byte0 = 1;
        System.arraycopy(_mth5D2A(_mth8E11(_mth38B5()) ^ l - System.currentTimeMillis() >> 63 & 1L), 0, abyte1, 0, 8);
        abyte1[8] = 99;
        abyte1[9] = -58;
        abyte1[10] = -38;
        abyte1[11] = 23;
        abyte1[12] = 29;
        abyte1[13] = -18;
        abyte1[14] = -107;
        abyte1[15] = -9;
        break MISSING_BLOCK_LABEL_591;
        throwable;
        throwable = throwable;
        abyte1[8] = 99;
        abyte1[9] = -58;
        abyte1[10] = -38;
        abyte1[11] = 23;
        abyte1[12] = 29;
        abyte1[13] = -18;
        abyte1[14] = -107;
        abyte1[15] = -9;
        break MISSING_BLOCK_LABEL_591;
        throwable1;
        throwable1 = throwable1;
        abyte1[8] = 99;
        abyte1[9] = -58;
        abyte1[10] = -38;
        abyte1[11] = 23;
        abyte1[12] = 29;
        abyte1[13] = -18;
        abyte1[14] = -107;
        abyte1[15] = -9;
        throw throwable1;
_L15:
        if(k2 != 0) goto _L5; else goto _L4
_L4:
        JVM INSTR pop ;
        k2++;
        l1 = 0;
        throwable1 = 0;
          goto _L6
_L14:
        if(byte0 != 0) goto _L8; else goto _L7
_L7:
        JVM INSTR pop ;
        byte0 = 2;
        if(throwable1 >= 16) goto _L10; else goto _L9
_L9:
        ai6[(l1 >> 2) * 4 + l1 & 3] = abyte1[throwable1] & 0xff | (abyte1[throwable1 + 1] & 0xff) << 8 | (abyte1[throwable1 + 2] & 0xff) << 16 | abyte1[throwable1 + 3] << 24;
        throwable1 += 4;
        l1++;
          goto _L6
_L8:
        throwable1;
_L10:
        int i2 = i + 1 << 2;
        for(int j2 = j; j2 < i2; j2++)
        {
            int i1 = ai6[(j2 - 1 >> 2) * 4 + (j2 - 1 & 3)];
            if(j2 % j == 0)
                i1 = BC76(abyte0, _mth76FB(i1, 8)) ^ ai5[j2 / j - 1];
            else
            if(j > 6 && j2 % j == 4)
                i1 = BC76(abyte0, i1);
            ai6[(j2 >> 2) * 4 + (j2 & 3)] = ai6[(j2 - j >> 2) * 4 + (j2 - j & 3)] ^ i1;
        }

          goto _L11
_L5:
        obj;
_L11:
        int ai7[] = new int[4];
        ai7[0] = 0x5ab803e7;
        ai7[1] = 0x5c782d88;
        ai7[2] = 0xd4045009;
        ai7[3] = 0x5d372115;
        Object aobj[] = new Object[7];
        aobj[0] = abyte0;
        aobj[1] = ai1;
        aobj[2] = ai2;
        aobj[3] = ai3;
        aobj[4] = ai4;
        aobj[5] = ai6;
        aobj[6] = ai7;
        _fld8F03 = aobj;
        return;
        byte0 = 0;
        boolean flag = false;
        int ai[] = new int[256];
        byte abyte0[] = new byte[256];
        int ai1[] = new int[256];
        int ai2[] = new int[256];
        int ai3[] = new int[256];
        int ai4[] = new int[256];
        int ai5[] = new int[30];
        long l = 0x97484b969418L;
        int j = 0;
        int k = 1;
        for(; j < 256; j++)
        {
            ai[j] = k;
            k ^= k << 1 ^ (k >>> 7) * 283;
        }

        int i;
        Throwable throwable;
        Throwable throwable1;
        byte abyte1[];
        int ai6[];
        int l1;
        Object obj;
        abyte0[0] = 99;
        byte0 = 0;
        null;
          goto _L12
_L3:
        abyte1 = new byte[16];
        byte0 = 0;
        null;
          goto _L13
_L6:
        byte0 = 0;
        null;
          goto _L14
        j = 4;
        i = j + 6;
        int k2;
        ai6 = new int[(i + 1) * 4];
        k2 = 0;
        null;
          goto _L15
    }

    static final String D509(String s)
    {
_L10:
        if(k4 != 0) goto _L2; else goto _L1
_L1:
        JVM INSTR pop ;
        k4++;
        j1 = s.length;
        k1 = 0;
_L8:
        if(k1 >= j1) goto _L4; else goto _L3
_L9:
        if(flag1) goto _L6; else goto _L5
_L5:
        JVM INSTR pop ;
        flag1 = true;
        switch(k1 % 8)
        {
        case 0: // '\0'
            s[k1] = (char)(k >> 16 ^ s[k1]);
            break;

        case 1: // '\001'
            s[k1] = (char)(k ^ s[k1]);
            break;

        case 2: // '\002'
            s[k1] = (char)(l >> 16 ^ s[k1]);
            break;

        case 3: // '\003'
            s[k1] = (char)(l ^ s[k1]);
            break;

        case 4: // '\004'
            s[k1] = (char)(i1 >> 16 ^ s[k1]);
            break;

        case 5: // '\005'
            s[k1] = (char)(i1 ^ s[k1]);
            break;

        case 6: // '\006'
            s[k1] = (char)(j >> 16 ^ s[k1]);
            break;

        case 7: // '\007'
            s[k1] = (char)(j ^ s[k1]);
            break;
        }
          goto _L7
_L6:
        obj;
_L7:
        k1++;
          goto _L8
_L2:
        obj1;
_L4:
        return new String(s);
_L3:
        Object obj;
        Object obj1;
        boolean flag1;
        if(k1 % 8 == 0)
        {
            int l1 = 0;
            l1 = 0;
            l1 = 0;
            l1 = 0;
            int i2 = k ^ ai[0];
            int j2 = l ^ ai[1];
            int k2 = i1 ^ ai[2];
            int l2 = j ^ ai[3];
            for(l1 = 4; l1 < 36; l1 += 4)
            {
                int i3 = ai2[i2 & 0xff] ^ ai3[j2 >> 8 & 0xff] ^ ai4[k2 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
                int k3 = ai2[j2 & 0xff] ^ ai3[k2 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i2 >>> 24] ^ ai[l1 + 1];
                int i4 = ai2[k2 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i2 >> 16 & 0xff] ^ ai5[j2 >>> 24] ^ ai[l1 + 2];
                l2 = ai2[l2 & 0xff] ^ ai3[i2 >> 8 & 0xff] ^ ai4[j2 >> 16 & 0xff] ^ ai5[k2 >>> 24] ^ ai[l1 + 3];
                l1 += 4;
                i2 = ai2[i3 & 0xff] ^ ai3[k3 >> 8 & 0xff] ^ ai4[i4 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
                j2 = ai2[k3 & 0xff] ^ ai3[i4 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i3 >>> 24] ^ ai[l1 + 1];
                k2 = ai2[i4 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i3 >> 16 & 0xff] ^ ai5[k3 >>> 24] ^ ai[l1 + 2];
                l2 = ai2[l2 & 0xff] ^ ai3[i3 >> 8 & 0xff] ^ ai4[k3 >> 16 & 0xff] ^ ai5[i4 >>> 24] ^ ai[l1 + 3];
            }

            int j4 = ai2[i2 & 0xff] ^ ai3[j2 >> 8 & 0xff] ^ ai4[k2 >> 16 & 0xff] ^ ai5[l2 >>> 24] ^ ai[l1];
            int l3 = ai2[j2 & 0xff] ^ ai3[k2 >> 8 & 0xff] ^ ai4[l2 >> 16 & 0xff] ^ ai5[i2 >>> 24] ^ ai[l1 + 1];
            int j3 = ai2[k2 & 0xff] ^ ai3[l2 >> 8 & 0xff] ^ ai4[i2 >> 16 & 0xff] ^ ai5[j2 >>> 24] ^ ai[l1 + 2];
            l2 = ai2[l2 & 0xff] ^ ai3[i2 >> 8 & 0xff] ^ ai4[j2 >> 16 & 0xff] ^ ai5[k2 >>> 24] ^ ai[l1 + 3];
            k2 = l1 + 4;
            k = abyte0[j4 & 0xff] & 0xff ^ (abyte0[l3 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[j3 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[l2 >>> 24] << 24 ^ ai[k2 + 0];
            l = abyte0[l3 & 0xff] & 0xff ^ (abyte0[j3 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[l2 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[j4 >>> 24] << 24 ^ ai[k2 + 1];
            i1 = abyte0[j3 & 0xff] & 0xff ^ (abyte0[l2 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[j4 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[l3 >>> 24] << 24 ^ ai[k2 + 2];
            j = abyte0[l2 & 0xff] & 0xff ^ (abyte0[j4 >> 8 & 0xff] & 0xff) << 8 ^ (abyte0[l3 >> 16 & 0xff] & 0xff) << 16 ^ abyte0[j3 >>> 24] << 24 ^ ai[k2 + 3];
        }
        flag1 = false;
        null;
          goto _L9
        boolean flag = false;
        int k4 = 0;
        if(_fld8F03 == null)
            _mth1D5B();
        astacktraceelement = Thread.currentThread().getStackTrace();
        StringBuilder stringbuilder = JVM INSTR new #71  <Class StringBuilder>;
        stringbuilder.StringBuilder();
        String s1 = astacktraceelement[2].getClassName();
        stringbuilder = stringbuilder.append(s1);
        s1 = astacktraceelement[2].getMethodName();
        int i = stringbuilder.append(s1).toString().hashCode();
        int ai1[] = (int[])(int[])_fld8F03[6];
        int k = i ^ ai1[0];
        int l = i ^ ai1[1];
        int i1 = i ^ ai1[2];
        int j = i ^ ai1[3];
        int ai[] = (int[])(int[])_fld8F03[5];
        int ai2[] = (int[])(int[])_fld8F03[1];
        int ai3[] = (int[])(int[])_fld8F03[2];
        int ai4[] = (int[])(int[])_fld8F03[3];
        int ai5[] = (int[])(int[])_fld8F03[4];
        byte abyte0[] = (byte[])(byte[])_fld8F03[0];
        int j1;
        int k1;
        s = s.toCharArray();
        k4 = 0;
        null;
          goto _L10
    }

    private static Object _fld8F03[];
}


*/

?>