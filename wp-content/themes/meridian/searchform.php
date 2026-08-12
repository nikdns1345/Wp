<?php
/**
 * فرم جستجو — مینیمال با فیلد شناور.
 *
 * @package Meridian
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<form role="search" method="get" class="mrd-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex;gap:var(--space-2);max-width:520px;margin-top:var(--space-4)">
	<label class="screen-reader-text" for="mrd-s"><?php echo esc_html_x( 'جستجو برای:', 'label', 'meridian' ); ?></label>
	<input type="search" id="mrd-s" name="s" value="<?php the_search_query(); ?>"
		placeholder="عبارت موردنظر…" class="mrd-input" style="flex:1;padding:var(--space-2) var(--space-3);border:1px solid var(--c-line);background:transparent;font:inherit;color:inherit">
	<button type="submit" class="mrd-btn mrd-btn--solid mrd-btn--sm">
		<span class="mrd-btn__label">جستجو</span>
	</button>
</form>
