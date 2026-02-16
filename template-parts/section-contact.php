<div id="kontakt" class="section">
		<div class="footer__content-wrapper">

		<div class="section__header">
			<h3 class="button--dark">Kontakt</h3>
	<?php 
	$links = get_field("links", "option");
	if ($links): 
	?>
		<ul class="footer__links">
		<?php foreach ($links as $link): ?>
			<li>
				<a rel="noopener noreferrer" target="_blank" class="button--dark" href="<?php echo esc_url($link['url']); ?>">
					<?php echo esc_html($link['label']); ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php
	endif;
?>
	</div>	
	<?php 
		$team = get_field("team", "option");
		if ($team): 
		?>
			<ul class="footer__team">
				<?php foreach ($team as $team_member): ?>
					<li>
						<div class="footer__team-card">
							<img class="team-card__img" src="<?php echo esc_url($team_member['featuredImage']['sizes']['large']); ?>" alt=""/>
							<div class="team-card__info">
								<h4><?php echo $team_member['position'] ?></h4>
								<p><?php echo $team_member['contact'] ?></p>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			</div>
		<?php endif; 
		$footer = get_field("footer", "option");
		$logos = get_field("logos", "option");
		?>
		<div class="footer__footer">
			<?php 
			if ($footer): ?>
			<div>
				<h4><?php echo $footer['title']; ?></h4>
				<p><?php echo $footer['body']; ?></p>
			</div>
			<?php
		endif;
		if ($logos):
			 ?>
			 <div class="footer__logos-list">

				 <?php 
			foreach ( $logos as $logo ):
				?>
			<img src="<?php echo esc_url($logo["logo"]["url"]) ?>" alt="<?php echo $logo['nimi']?> logo">
<?php 
	endforeach;
	?>
	</div>
	<?php 
		endif;
	 ?>
		</div>

</div>