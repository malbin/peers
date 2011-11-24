<div id="invite-overlay" style="display:none">
	<div id="invite-wrap">
		<div id="invite-friends-overlay">
			<p style="font-weight:200; font-size:30px; text-align: center;">invite</p> 
			<!-- <span id="last" style="font-weight:200;">INVITE</span> -->
			<span class="close">&#10006;</span>
			<form action="/site_invite/friends" id="invite-friends-form" method="get" onsubmit="return invite_friends()">

                                <br />
                                <div>
					<label for="invite-fname">Name</label>
					<input type="text" name="invite-fname" value="" id="invite-fname">
					<span class="error"></span>
				</div>
				<div>
					<label for="invite-email">email</label>
					<input type="text" name="invite-email" value="" id="invite-email" class="validate[required,custom[email]]">
					<span class="error"></span>
				</div>
				<input type="submit" name="some_name" value="submit" id="invite-friend-submit">
			</form>
		</div>
	</div>
</div>
