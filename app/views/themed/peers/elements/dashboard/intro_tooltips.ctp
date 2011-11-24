<!-- <div class="intro-tooltip" id="groups-intro-tooltip"> 
	<span class="skip">skip</span>   
	<h3 class="title">Groups</h3>
	<p class="detail">Groups are useful for privately categorizing the people with whom you like to be compared.</p>
 </div>

<div class="intro-tooltip" id="roster-intro-tooltip"> 
	<span class="skip">skip</span>   
	<h3 class="title">Board Roster</h3>
	<p class="detail">This is the board roster. All board participants are listed in this panel.</p>
 </div>

<div class="intro-tooltip" id="report-intro-tooltip"> 
	<span class="skip">skip</span>   
	<h3 class="title">Board Report</h3>
	<p class="detail">This is the board report. The report 
	represents your rank amonf all 
	participants. Other participants can 
	not view your rank or your 
	compensation.</p>
 </div>

<div class="intro-tooltip" id="board-intro-tooltip"> 
	<span class="skip">skip</span>   
	<h3 class="title">Start a Board</h3>
	<p class="detail">So what are you waiting for? Dive in now and start your own board. Invite your friends, co-workers, and whoever else you want to rank with.</p>
 </div> -->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('#groups-intro-tooltip').css({'top':'200px','left':'50%'}).css('marginLeft','100px').fadeIn(500);
		$('#board-intro-tooltip').css({'top':'600px','left':'50%'}).css('marginLeft','150px').fadeIn(500);
		$('#roster-intro-tooltip').css({'top':'670px','left':'50%'}).css('marginLeft','-320px').fadeIn(500);

		$('.intro-tooltip .skip').live('click',function(){
			$(this).parent().fadeOut(100, function(){
                $(this).remove();
            });
		});
	});
</script>
