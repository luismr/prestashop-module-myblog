<!-- Block MyBlog module -->
<!--
/*
 * Module ......: blockmyblog
 * File ........: blockmyblog.tpl
 * Description .: Simple Prestashop Module to publish My Blog Ad links on template
 * Authot ......: Luis Machado Reis <luis.reis@singularideas.com.br>
 * Licence .....: GNU Lesser General Public License V3
 * Created .....: 01/09/2010
 */
-->
<div id="tags_block_left" class="block tags_block">
	<h4>{l s='My Blog' mod='blockmyblog'}</h4>
	<p class="block_content" style="text-align:right">
    {if $name and $url and $logo}
		<a href="{$url}" title="{$name}" target="_blank"><img src="{$logo}" alt="{$name}" border="0"/></a>
    {/if}
	</p>
</div>
<!-- /Block MyBlog  module -->
