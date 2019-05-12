
	<link rel="stylesheet" type="text/css" href="src/jquery.tagsinput.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="src/jquery.tagsinput.js"></script>

	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />


	<script type="text/javascript">
		$(function() {

			$('#tags').tagsInput({width:'auto'});
		});

	</script>
		<form method="get" action="example.php">
			<p><label>Defaults:</label>
			<input id="tags" type="text" class="tags" name="maling"/></p>
			<input type="submit">
		</form>
<select class="form-control" name="enginelist" id="enginelist">
                                	<option value="">Choose engine below</option>
                                	<option value="1">***</option><option value="2">GTCP131-9A</option><option value="3">GTCP131-9B</option><option value="4">GTCP331-350</option><option value="5">GTCP331-500</option><option value="6">CF34-8C5A1</option><option value="7">CF6-80C2B1F</option><option value="8">CFM56-7B-24</option><option value="9">CFM56-7B-26</option><option value="10">CFM56-3C-1</option><option value="11">CFM56-5B4/3</option><option value="12">GE90-115BG02</option><option value="13">TRENT-768</option><option value="14">TRENT-772</option><option value="15">RE220RJ</option><option value="16">V2527-A5</option><option value="17">CFM LEAP-1A26</option><option value="18">CFM LEAP-1B25</option><option value="19">PWC PW127M</option><option value="20">CFM56</option><option value="21">CF6-80C</option><option value="22">CF6-80C2</option><option value="23">CFM 56-7B</option><option value="24">CFM56-3C</option><option value="25">CFM56-5B</option><option value="26">GE90-100</option><option value="27">GTCP331-350[C]</option><option value="28">GTCP331-350C</option><option value="29">RE220[FD]</option><option value="30">RE220[GV]</option><option value="31">RE220[GX]</option><option value="32">RE220[RJ]</option><option value="33">RE220[SJ]</option><option value="34">TRENT-768-60</option><option value="35">CFM56-7B</option><option value="36">CF34-8</option><option value="37">PW127</option><option value="38">PW124B</option><option value="39">PW127E</option><option value="40">CFM 56-3</option><option value="41">Leap-1B</option><option value="42">TRENT 700</option><option value="43">RB211</option><option value="44">TRENT 500</option><option value="45">Engine-Leap 1B</option>                                </select>
<?php
if(@$_GET['maling'])
{
	echo "jalan bro<br>";
	echo $_GET['maling'];
}
?>
 <script>
            $(document).ready(function(){
                $(document).on('change', '#enginelist', function(){
                    var val = $(this).val();
                    var strui = $("#enginelist option[value='"+val+"']").text();
                    $('#tags').addTag(strui + "",{focus:true,unique:(true)});
                });
				
			});
        </script>
