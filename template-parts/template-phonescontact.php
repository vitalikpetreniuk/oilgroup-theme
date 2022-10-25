<section class="phones-contact no-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="inn">
					<div class="title">
						<?php esc_html_e('Need a consultation', 'oilgroup'); ?>
					</div>
					<?php
					$tel1stripped = str_replace( [ ' ', '(', ')', '-' ], '', get_field( 'tel1', 'option' ) );
					$tel2stripped = str_replace( [ ' ', '(', ')', '-' ], '', get_field( 'tel2', 'option' ) );
					?>
					<div class="phones">
						<a href="tel:<?= $tel1stripped ?>">
							<?php the_field( 'tel1', 'option' ) ?>
						</a>
						<a href="tel:<?= $tel2stripped ?>">
							<?php the_field( 'tel2', 'option' ) ?>
						</a>
					</div>
				</div>

			</div>
			<div class="col-lg-6">
				<div class="inn">
					<a href="#" class="request modal-open">
						<?php esc_html_e('Send a request', 'oilgroup'); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
