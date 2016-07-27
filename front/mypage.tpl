<div class="panel-footer">
  <ul class="pagination m-t-sm m-b-sm">
    <li><a href="./index.php"><i class="fa fa-chevron-left"></i></a></li>
    {#if $logs['total_pages'] > 5#}
    <li class="{#if $logs['currentPage'] eq 1#}active{#/if#}"><a href="{#if $logs['currentPage'] < 3#}./index.php{#elseif $logs['currentPage'] > $logs['total_pages']-2#}./index.php?page={#$logs['total_pages']-4#}{#else#}./index.php?page={#$logs['currentPage']-2#}{#/if#}">{#if $logs['currentPage'] < 3#}1{#elseif $logs['currentPage'] > $logs['total_pages']-2#}{#$logs['total_pages']-4#}{#else#}{#$logs['currentPage']-2#}{#/if#}</a></li>
    <li class="{#if $logs['currentPage'] eq 2#}active{#/if#}"><a href="{#if $logs['currentPage'] < 3#}./index.php?page=2{#elseif $logs['currentPage'] > $logs['total_pages']-2#}./index.php?page={#$logs['currentPage']-3#}{#else#}./index.php?page={#$logs['currentPage']-1#}{#/if#}">{#if $logs['currentPage'] < 3#}2{#elseif $logs['currentPage'] > $logs['total_pages']-2#}{#$logs['currentPage']-3#}{#else#}{#$logs['currentPage']-1#}{#/if#}</a></li>
    <li class="{#if $logs['currentPage'] >= 3 and $logs['currentPage'] <= ($logs['total_pages']-2)#}active{#/if#}"><a href="{#if $logs['currentPage'] >= 3 and $logs['currentPage'] <= ($logs['total_pages']-2)#}./index.php?page={#$logs['currentPage']#}{#elseif $logs['currentPage'] < 3#}./index.php?page=3{#else#}./index.php?page={#$logs['total_pages']-2#}{#/if#}">{#if $logs['currentPage'] >= 3 and $logs['currentPage'] <= ($logs['total_pages']-2)#}{#$logs['currentPage']#}{#elseif $logs['currentPage'] < 3#}3{#else#}{#$logs['total_pages']-2#}{#/if#}</a></li>
    <li class="{#if $logs['currentPage'] eq $logs['total_pages']-1#}active{#/if#}"><a href="{#if $logs['currentPage'] < 3#}./index.php?page=4{#elseif $logs['currentPage'] > $logs['total_pages']-2#}./index.php?page={#$logs['total_pages']-1#}{#else#}./index.php?page={#$logs['currentPage']+1#}{#/if#}">{#if $logs['currentPage'] < 3#}4{#elseif $logs['currentPage'] > $logs['total_pages']-2#}{#$logs['total_pages']-1#}{#else#}{#$logs['currentPage']+1#}{#/if#}</a></li>
    <li class="{#if $logs['currentPage'] eq $logs['total_pages']#}active{#/if#}"><a href="{#if $logs['currentPage'] < 3#}./index.php?page=5{#elseif $logs['currentPage'] > $logs['total_pages']-2#}./index.php?page={#$logs['total_pages']#}{#else#}./index.php?page={#$logs['currentPage']+2#}{#/if#}">{#if $logs['currentPage'] < 3#}5{#elseif $logs['currentPage'] > $logs['total_pages']-2#}{#$logs['total_pages']#}{#else#}{#$logs['currentPage']+2#}{#/if#}</a></li>
    {#else#}
    {#section name=loop loop=$logs['total_pages']#}
      <li class="{#if $logs['currentPage'] eq $smarty.section.loop.index+1#}active{#/if#}"><a href="./index.php?page={#$smarty.section.loop.index+1#}">{#$smarty.section.loop.index+1#}</a></li>
    {#/section#}
    {#/if#}
    <li><a href="./index.php?page={#$logs['total_pages']#}"><i class="fa fa-chevron-right"></i></a></li>
  </ul>
</div>
