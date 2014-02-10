<script type='text/javascript'>
if (top.location!= self.location)
{
top.location = self.location
}
</script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'504758429642004',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
FB.ui({
method: 'apprequests',
message: 'Your Message diaolog'
});
}
</script>


<div id="fb-root"></div>
<a href='#' onclick="FacebookInviteFriends();">
Facebook Invite Friends Link
</a>