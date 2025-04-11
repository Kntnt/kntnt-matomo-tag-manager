<?php if ( ! isset( $escaped_matomo_url ) ) {
	return;
} ?>

<script>
  var _mtm = window._mtm = window._mtm || []
  _mtm.push({ 'mtm.startTime': (new Date().getTime()), 'event': 'mtm.Start' });
  (function () {
    var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0]
    g.async = true
    g.src = '<?php echo $escaped_matomo_url; ?>'
    s.parentNode.insertBefore(g, s)
  })()
</script>
