 <table cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr class="clientform-border">
                <td class="head" colspan="7"><h4>Редактирование зоны</h4></td>
            </tr>
            <tr class="clientform-subheader">
                <td nowrap="" width="20%"><b>Доменное имя:</b></td>
                <td width="15%">jday.in.ua</td>
                <td width="20%"><b>TTL:</b></td>
                <td width="15%">
                    <select style="display: none;" name="zone[ttl]">
                                                    <option value="900">900 (15 минут)</option>
                                                    <option selected="selected" value="3600">3600 (1 час)</option>
                                                    <option value="10800">10800 (3 часа)</option>
                                                    <option value="21600">21600 (6 часов)</option>
                                                    <option value="43200">43200 (12 часов)</option>
                                                    <option value="86400">86400 (24 часа)</option>
                                                    <option value="259200">259200 (72 часа)</option>
                                            </select><div style="width: 272px;" class="custom dropdown"><a href="#" class="current">3600 (1 час)</a><a href="#" class="selector"></a><ul style="width: 270px;"><li>900 (15 минут)</li><li class="selected">3600 (1 час)</li><li>10800 (3 часа)</li><li>21600 (6 часов)</li><li>43200 (12 часов)</li><li>86400 (24 часа)</li><li>259200 (72 часа)</li></ul></div>
                </td>
                <td width="15%"><b>Serial:</b></td>
                <td width="15%">2012121601</td>
            </tr>
            <tr>
                <td><b>Refresh:</b></td>
                <td><input class="input-text" name="zone[refresh]" value="14400" size="9" placeholder="weight" type="text"></td>
                <td><b>Retry:</b></td>
                <td><input class="input-text" name="zone[retry]" value="7200" size="9" placeholder="retry" type="text"></td>
                <td><b>Expire:</b></td>
                <td><input class="input-text" name="zone[expire]" value="604800" size="9" placeholder="expire" type="text"></td>
            </tr>
            <tr>
                <td colspan="7" align="right">&nbsp;</td>
            </tr>
        </tbody></table>

        <table id="zone_records" class="display" border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="essential" width="15px">#</th>
                <th class="essential" width="40%">домен</th>
                <th class="essential" style="text-align: center;" width="9%">тип</th>
                <th class="essential" width="9%">приоритет</th>
                <th class="essential" width="22%">данные</th>
                <th class="essential" width="25%">&nbsp;</th>
            </tr>
        </thead>



                    <tbody><tr id="record_0">
                        <input name="zone[records][0][id]" value="3488039" type="hidden">
                        <td align="right">1</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][0][domain]" value="@" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][0][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][0][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_0">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_1">
                        <input name="zone[records][1][id]" value="3488040" type="hidden">
                        <td align="right">2</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][1][domain]" value="promedia" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][1][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][1][data]" value="93.126.65.24" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_1">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_2">
                        <input name="zone[records][2][id]" value="3488041" type="hidden">
                        <td align="right">3</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][2][domain]" value="core45" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][2][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][2][data]" value="93.126.65.23" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_2">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_3">
                        <input name="zone[records][3][id]" value="3488042" type="hidden">
                        <td align="right">4</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][3][domain]" value="shop3" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][3][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][3][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_3">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_4">
                        <input name="zone[records][4][id]" value="3488043" type="hidden">
                        <td align="right">5</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][4][domain]" value="by" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][4][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][4][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_4">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_5">
                        <input name="zone[records][5][id]" value="3488044" type="hidden">
                        <td align="right">6</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][5][domain]" value="php" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][5][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][5][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_5">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_6">
                        <input name="zone[records][6][id]" value="3488045" type="hidden">
                        <td align="right">7</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][6][domain]" value="l2" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][6][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][6][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_6">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_7">
                        <input name="zone[records][7][id]" value="3488046" type="hidden">
                        <td align="right">8</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][7][domain]" value="media" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][7][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][7][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_7">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_8">
                        <input name="zone[records][8][id]" value="3488047" type="hidden">
                        <td align="right">9</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][8][domain]" value="shop2" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][8][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][8][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_8">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_9">
                        <input name="zone[records][9][id]" value="3488048" type="hidden">
                        <td align="right">10</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][9][domain]" value="shop4" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][9][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][9][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_9">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_10">
                        <input name="zone[records][10][id]" value="3488049" type="hidden">
                        <td align="right">11</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][10][domain]" value="torrent" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][10][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][10][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_10">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_11">
                        <input name="zone[records][11][id]" value="3488050" type="hidden">
                        <td align="right">12</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][11][domain]" value="www" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][11][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][11][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_11">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_12">
                        <input name="zone[records][12][id]" value="3488051" type="hidden">
                        <td align="right">13</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][12][domain]" value="cs" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][12][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][12][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_12">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_13">
                        <input name="zone[records][13][id]" value="3488052" type="hidden">
                        <td align="right">14</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][13][domain]" value="d-net" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][13][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][13][data]" value="93.126.65.20" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_13">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_14">
                        <input name="zone[records][14][id]" value="3488053" type="hidden">
                        <td align="right">15</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][14][domain]" value="forum2" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][14][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][14][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_14">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_15">
                        <input name="zone[records][15][id]" value="3488054" type="hidden">
                        <td align="right">16</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][15][domain]" value="books" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][15][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][15][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_15">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_16">
                        <input name="zone[records][16][id]" value="3488055" type="hidden">
                        <td align="right">17</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][16][domain]" value="iphone" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][16][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][16][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_16">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_17">
                        <input name="zone[records][17][id]" value="3488056" type="hidden">
                        <td align="right">18</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][17][domain]" value="proline" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][17][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][17][data]" value="93.126.65.24" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_17">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_18">
                        <input name="zone[records][18][id]" value="3488057" type="hidden">
                        <td align="right">19</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][18][domain]" value="forums" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][18][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][18][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_18">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_19">
                        <input name="zone[records][19][id]" value="3488058" type="hidden">
                        <td align="right">20</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][19][domain]" value="shop1" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][19][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][19][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_19">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_20">
                        <input name="zone[records][20][id]" value="3488059" type="hidden">
                        <td align="right">21</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][20][domain]" value="mail" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][20][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][20][data]" value="93.126.65.2" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_20">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_21">
                        <input name="zone[records][21][id]" value="3488060" type="hidden">
                        <td align="right">22</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][21][domain]" value="music" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][21][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][21][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_21">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_22">
                        <input name="zone[records][22][id]" value="3488061" type="hidden">
                        <td align="right">23</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][22][domain]" value="bad" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][22][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][22][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_22">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_23">
                        <input name="zone[records][23][id]" value="3488062" type="hidden">
                        <td align="right">24</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][23][domain]" value="war" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][23][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][23][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_23">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_24">
                        <input name="zone[records][24][id]" value="3488063" type="hidden">
                        <td align="right">25</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][24][domain]" value="test" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][24][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][24][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_24">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_25">
                        <input name="zone[records][25][id]" value="3488064" type="hidden">
                        <td align="right">26</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][25][domain]" value="noc" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][25][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][25][data]" value="93.126.65.24" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_25">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_26">
                        <input name="zone[records][26][id]" value="3488065" type="hidden">
                        <td align="right">27</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][26][domain]" value="forum3" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][26][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][26][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_26">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_27">
                        <input name="zone[records][27][id]" value="3488066" type="hidden">
                        <td align="right">28</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][27][domain]" value="hosting" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][27][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][27][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_27">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_28">
                        <input name="zone[records][28][id]" value="3488067" type="hidden">
                        <td align="right">29</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][28][domain]" value="shop5" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][28][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][28][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_28">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_29">
                        <input name="zone[records][29][id]" value="3488068" type="hidden">
                        <td align="right">30</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][29][domain]" value="lw" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][29][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][29][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_29">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_30">
                        <input name="zone[records][30][id]" value="3488069" type="hidden">
                        <td align="right">31</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][30][domain]" value="forum1" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][30][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][30][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_30">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_31">
                        <input name="zone[records][31][id]" value="3488070" type="hidden">
                        <td align="right">32</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][31][domain]" value="minecraft" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][31][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][31][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_31">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_32">
                        <input name="zone[records][32][id]" value="3488071" type="hidden">
                        <td align="right">33</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][32][domain]" value="@" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][32][type]" value="MX" size="8" type="hidden">MX</td>
                            <td align="center" width="9%"><input class="input-text" style="width: 30px;" name="zone[records][32][pref]" value="10" size="2" placeholder="pref" type="text"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][32][data]" value="mail.jday.in.ua." style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_32">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_33">
                        <input name="zone[records][33][id]" value="3488072" type="hidden">
                        <td align="right">34</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][33][domain]" value="noc" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][33][type]" value="MX" size="8" type="hidden">MX</td>
                            <td align="center" width="9%"><input class="input-text" style="width: 30px;" name="zone[records][33][pref]" value="10" size="2" placeholder="pref" type="text"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][33][data]" value="mail.jday.in.ua." style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_33">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_34">
                        <input name="zone[records][34][id]" value="3488073" type="hidden">
                        <td align="right">35</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][34][domain]" value="narko" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][34][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][34][data]" value="194.114.136.11" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_34">Удалить запись</a></u></td>
                                            </tr>



                    <tr id="record_35">
                        <input name="zone[records][35][id]" value="3488074" type="hidden">
                        <td align="right">36</td>
                                                    <td align="left" width="40%"><input class="input-text" style="width: 100px; display: inline; text-align:right;" name="zone[records][35][domain]" value="blog" size="15" placeholder="subdomain" type="text"><font style="font-size: 11px">.jday.in.ua.</font></td>
                            <td align="center" width="9%"><input name="zone[records][35][type]" value="A" size="8" type="hidden">A</td>
                            <td align="center" width="9%"></td>
                            <td align="center" width="22%"><input class="input-text" name="zone[records][35][data]" value="194.114.136.10" style="width: 200px;" placeholder="data" type="text"></td>
                            <td align="center" width="25%"><u><a href="#" id="del_rec_35">Удалить запись</a></u></td>
                                            </tr>


            <script type="text/javascript">
                var recordsCount = 36;
                var recordsRow = 1;
            </script>

            <tr id="zone_records_buttons" class="clientform-noborder">
                <td colspan="5" style="text-align: center; padding-top: 20px;">
                    <u><a href="#" id="btn_record_add">Добавить запись</a></u>
                    &nbsp;<button class="button small radius" type="submit">Сохранить настройки</button>
                </td>
            </tr>
        </tbody>
 </table>