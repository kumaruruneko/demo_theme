<?php
function get_custom_company_setting()
{
	$opt_name = 'custom_top_company';
	$opt_val = get_option($opt_name);
	$company = (!empty($opt_val['company'])) ? $opt_val['company'] : '';
	$zip = (!empty($opt_val['zip'])) ? $opt_val['zip'] : '';
	if (!empty($zip)) {
		$explode = explode('-', $zip);
		$zip1 = $explode[0];
		$zip2 = $explode[1];
	} else {
		$zip1 = '';
		$zip2 = '';
	}
	$pref = (!empty($opt_val['pref'])) ? $opt_val['pref'] : '';
	$city = (!empty($opt_val['city'])) ? $opt_val['city'] : '';
	$address = (!empty($opt_val['address'])) ? $opt_val['address'] : '';
	$buildings = (!empty($opt_val['buildings'])) ? $opt_val['buildings'] : '';
	$person = (!empty($opt_val['person'])) ? $opt_val['person'] : '';
	$tel = (!empty($opt_val['tel'])) ? $opt_val['tel'] : '';
	$fax = (!empty($opt_val['fax'])) ? $opt_val['fax'] : '';
	$business = (!empty($opt_val['business'])) ? $opt_val['business'] : '';
	$establishment = (!empty($opt_val['establishment'])) ? $opt_val['establishment'] : '';
	$capital = (!empty($opt_val['capital'])) ? $opt_val['capital'] : '';
	$pref_select = get_prefectures_select($pref);
	$contents = <<<__HTML__
		<div class="form-group">
			<label for="company">会社名または事業名</label>
			<input type="text" name="custom_data[{$opt_name}][company]" class="form-control" id="company" value="{$company}">
		</div>
		<div class="form-group">
			<label for="zip1">郵便番号</label>
			<div class="form-inline">
				<input type="text" class="form-control" id="zip1" size="6" maxlength='3' pattern="^[\d]+$" required value="{$zip1}"> -
				<input type="text" class="form-control" id="zip2" size="10" maxlength='4' pattern="^[\d]+$" required value="{$zip2}">
				<input type="hidden" name="custom_data[{$opt_name}][zip]" id="zip" value="{$zip}">
			</div>
		</div>
		<div class="form-group">
			<label for="pref">都道府県</label>
			<div class="form-inline">
				{$pref_select}
				<input type="hidden" name="custom_data[{$opt_name}][pref]" value="{$pref}" id="pref">
			</div>
		</div>
		<div class="form-group">
			<label for="city">市区町村</label>
			<div class="form-inline">
				<select class="form-control" id="city_select"></select>
				<input type="hidden" name="custom_data[{$opt_name}][city]" value="{$city}" id="city" required>
			</div>
		</div>
		<div class="form-group">
			<label for="address">番地等</label>
			<input type="text" name="custom_data[{$opt_name}][address]" class="form-control" id="address" value="{$address}" required>
		</div>
		<div class="form-group">
			<label for="buildings">建物名等</label>
			<input type="text" name="custom_data[{$opt_name}][buildings]" class="form-control" id="buildings" value=" $buildings" required>
		</div>
		<div class="form-group">
			<label for="person">代表者名</label>
			<div class="form-inline"><input type="text" name="custom_data[{$opt_name}][person]" class="form-control" id="person" value="{$person}"></div>
		</div>
		<div class="form-group">
			<label for="establishment">設立日</label>
			<div class="form-inline"><input type="text" name="custom_data[{$opt_name}][establishment]" class="form-control" id="establishment" value="{$establishment}"></div>
		</div>
		<div class="form-group">
			<label for="capital">資本金</label>
			<div class="form-inline"><input type="text" name="custom_data[{$opt_name}][capital]" class="form-control" id="capital" value="{$capital}"></div>
		</div>
		<div class="form-group">
			<label for="tel">TEL</label>
			<div class="form-inline"><input type="tel" name="custom_data[{$opt_name}][tel]" class="form-control" id="tel" value="{$tel}" placeholder="例：09000000000"></div>
		</div>
		<div class="form-group">
			<label for="fax">FAX</label>
			<div class="form-inline"><input type="tel" name="custom_data[{$opt_name}][fax]" class="form-control" id="fax" value="{$fax}" placeholder="例：0300000000"></div>
		</div>
		<div class="form-group">
			<label for="business">事業内容</label>
			<textarea name="custom_data[{$opt_name}][business]" class="form-control" rows="5" id="business">{$business}</textarea>
		</div>
__HTML__;
	$field = sprintf('<div class="field company_field">%1$s</div>', $contents);
	return $field;
}
