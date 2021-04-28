<div class="sub_key">
	<h1 class="title"><span class="">COMPANY</span><span class="sub">会社概要</span></h1>
</div>
<div class="main_content">
	<main>
		<div class="container box_pd_lg">
			<div class="maxw740 center-block">

				<table class="table_clear sp_table">

					<?php if (!empty($company['company'])) { ?>
						<tr>
							<th>会社名</th>
							<td>
								<?php echo $company['company']; ?>
							</td>
						</tr>
					<?php } ?>

					<tr>
						<th>住所</th>
						<td>
							〒<?php echo $company['zip']; ?><br>
							<?php echo $company['pref']; ?><?php echo $company['city']; ?><?php echo $company['address']; ?><?php echo $company['buildings']; ?>
						</td>
					</tr>

					<?php if (!empty($company['person'])) { ?>
						<tr>
							<th>代表者名</th>
							<td>
								<?php echo $company['person']; ?>
							</td>
						</tr>
					<?php } ?>

					<?php if (!empty($company['establishment'])) { ?>
						<tr>
							<th>設立日</th>
							<td>
								<?php echo $company['establishment']; ?>
							</td>
						</tr>
					<?php } ?>

					<?php if (!empty($company['capital'])) { ?>
						<tr>
							<th>資本金</th>
							<td>
								<?php echo $company['capital']; ?>
							</td>
						</tr>
					<?php } ?>

					<?php if (!empty($company['tel'])) { ?>
						<tr>
							<th>電話番号</th>
							<td>
								<?php echo $company['tel']; ?>
							</td>
						</tr>
					<?php } ?>

					<?php if (!empty($company['fax'])) { ?>
						<tr>
							<th>FAX</th>
							<td>
								<?php echo $company['fax']; ?>
							</td>
						</tr>
					<?php } ?>

					<?php if (!empty($company['business'])) { ?>
						<tr>
							<th>事業内容</th>
							<td>
								<?php echo nl2br($company['business']); ?>
							</td>
						</tr>
					<?php } ?>

				</table>

			</div>
		</div>

		<div class="ggmap">
			<iframe src="http://maps.google.co.jp/maps?q=<?php echo $map; ?>&output=embed&t=m&z=16&iwloc=A&hl=ja" scrolling="no" marginheight="0" marginwidth="0" width="600" height="450"></iframe>
		</div>
	</main>