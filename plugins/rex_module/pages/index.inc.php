<?php
$include_template_id = trim(rex_request('include_template_id', 'int'));

$config_file = $REX['INCLUDE_PATH'] . '/addons/be_extensions/plugins/rex_module/config.inc.php';

if (rex_request('func', 'string') == 'update') {
	$REX['ADDON']['rex_module']['include_template_id'] = $include_template_id;

	$content = '
		$REX[\'ADDON\'][\'rex_module\'][\'include_template_id\'] = ' . $include_template_id . ';
	';

	if (rex_replace_dynamic_contents($config_file, str_replace("\t", "", $content)) !== false) {
		echo rex_info($I18N->msg('be_extensions_configfile_update'));
	} else {
		echo rex_warning($I18N->msg('be_extensions_configfile_nosave'));
	}
}

if (!is_writable($config_file)) {
	echo rex_warning($I18N->msg('be_extensions_configfile_nowrite'), $config_file);
}

// templates
$sql = rex_sql::factory();
$sql->setQuery('select id, name from ' . $REX['TABLE_PREFIX'] . 'template order by name');
$templates = $sql->getArray();

$selectTemplates = new rex_select();
$selectTemplates->setName('include_template_id');
$selectTemplates->setSize(1);
$selectTemplates->addOption('<' . $I18N->msg('rex_module_none') . '>', '0');

foreach ($templates as $template) {
	$selectTemplates->addOption($template['name'], $template['id']);
}

$selectTemplates->setSelected($REX['ADDON']['rex_module']['include_template_id']);
?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('be_extensions_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="be_extensions" />
					<input type="hidden" name="subpage" value="plugin.rex_module" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row">
						<p class="rex-form-col-a rex-form-select">
							<label for="include_template_id"><?php echo $I18N->msg('rex_module_template'); ?></label>
							<?php echo $selectTemplates->get(); ?>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-col-a rex-form-read">
							<label for="css_file"><?php echo $I18N->msg('rex_module_css_file'); ?></label>
							<span class="rex-form-read" id="css_file"><code>/files/addons/be_extensions/plugins/rex_module/rex_module.css</code></span>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v2">
						<p class="rex-form-submit">
							<input type="submit" class="rex-form-submit" name="sendit" value="<?php echo $I18N->msg('be_extensions_settings_save'); ?>" />
						</p>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<style type="text/css">
div.rex-form-row label {
	width: 220px !important; 
}

span#css_file code {
	font-size: 0.9em;
}

</style>
