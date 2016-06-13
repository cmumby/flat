<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0">
  <channel>
    <title>{{$feed->title}}</title>
    <link>LINK</link>
    <description><![CDATA[FOXNews.com - Breaking news and video. Latest Current News: U.S., World, Entertainment, Health, Business, Technology, Politics, Sports.]]></description>
    <image>
    	<url>URL</url>
    	<title>{{$feed->title}}</title>
    	<link>Link</link>
    </image>
    @yield('items')
  </channel>
</rss>
