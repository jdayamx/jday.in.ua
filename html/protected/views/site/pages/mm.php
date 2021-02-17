<script>
var AddrDistrict = {

	"111": {"12": [ "2,5" ],"24": [ "1,25" ],"48": [ "0,65" ]},
	"211": {"12": [ "5,0" ],"24": [ "2,5" ],"36": [ "1,5" ],"48": [ "1,25" ]},
	"131": {"12": [ "10" ],"24": [ "5" ],"48": [ "2,5" ]},
	"250": {"12": [ "20,0" ],"24": [ "10,0" ],"48": [ "5,0" ]}
};



//alert(AddrDistrict["111"]["12"]);
</script>
<select onchange="var index, value = '<option value=\'\'>- Пусто -</option>';for (index in AddrDistrict[this.value]) {value += '<option>'+AddrDistrict[this.value][index] + '</option>'; };document.getElementById('test').innerHTML = value;">
<option value="">- Пусто -</option>
<option value="111">test 1</option>
<option value="211">test 2</option>
<option value="131">test 3</option>
<option value="250">test 3</option>
</select>

<select id="test">
<option value="">- Пусто -</option>
</select>
