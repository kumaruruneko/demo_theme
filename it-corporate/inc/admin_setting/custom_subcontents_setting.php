<?php
class mySettingPage
{
	public static $key = 'my_option_name'; //オプションへの保存、呼び出しキー

	private $html_title = 'サブコンテンツ設定'; //HTMLのタイトル（管理ページのtitleタグ）
	private $page_title = 'サブコンテンツ設定'; //ページのタイトル
	private $page_slug = 'my_option_page';

	private $options;
	private $group = 'my_option_group';
	private $section = 'my_setting_admin';

	//ここにキーとタイトル、コールバックをセットにして
	public static function getFields()
	{

		return array(
			array(
				'type' => 'section', //区切りを入れるときはtypeをセクションにする
				'name' => 'section1',
				'title' => '見出し設定',
				'callback' => 'section_callback',
			),
			array(
				'type' => 'field', //フィールドかセクション　お好みに合わせて追加
				'name' => 'item1', //名前
				'title' => 'タイトル', //タイトル
				'callback' => 'text_callback', //コールバック
			),
			array(
				'type' => 'field',
				'name' => 'item2',
				'title' => 'タイトル下の説明',
				'callback' => 'text_callback',
			),
			array(
				'type' => 'section', //区切りを入れるときはtypeをセクションにする
				'name' => 'section2',
				'title' => '',
				'callback' => 'section_callback',
			),

		);
	}

	//初期化
	public function __construct()
	{
		add_action('admin_menu', array($this, 'add_my_option_page'));
		add_action('admin_init', array($this, 'page_init'));
	}

	//キーを取得（外部から呼び出せるようにする）
	public static function getKey()
	{
		return self::$key;
	}

	//設定
	public function add_my_option_page()
	{
		add_submenu_page('custom_top_page', $this->html_title, $this->page_title, 'edit_themes', $this->page_title, array($this, 'create_admin_page'));
	}

	//フォームの外観作成
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option($this->getKey());
		?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo $this->page_title; ?></h2>
		<p>トップページの表示項目を設定</p>
		<form method="post" action="options.php">
			<?php
			// This prints out all hidden setting fields
			settings_fields($this->group);
			do_settings_sections($this->section);
			submit_button();
			?>
		</form>
	</div>
<?php
}

//フォームの部品組み立て
public function page_init()
{
	register_setting(
		$this->group, // Option group
		$this->getKey(), // Option name
		array($this, 'sanitize') // Sanitize
	);

	$fields = $this->getFields();
	$section_id = '';
	foreach ($fields as $field) {
		if ($field['type'] == 'field') {
			add_settings_section(
				$field['name'], // ID
				$field['title'], // Title
				array($this, $field['callback']), // Callback
				$this->section, // Page
				$section_id
			);
		} else {
			add_settings_section(
				$field['name'], // ID
				$field['title'], // Title
				array($this, $field['callback']), // Callback
				$this->section // Page
			);
			$section_id = $field['name'];
		}
	}
}

//保存前のサニタイズ
public function sanitize($input)
{

	$new_input = array();
	foreach ($this->getFields() as $field) {
		if (isset($input[$field['name']])) {
			$new_input[$field['name']] = sanitize_text_field($input[$field['name']]);
		}
	}
	return $new_input;
}

//セクション表示関数
public function section_callback(array $args)
{
	echo '<hr>';
}

//テキストフィール表示関数
public function text_callback(array $args)
{
	$name = $args['id'];
	printf(
		'<input type="text" id="' . $name . '" name="' . $this->getKey() . '[' . $name . ']" value="%s" />',
		isset($this->options[$name]) ? esc_attr($this->options[$name]) : ''
	);
}
}

if (is_admin())
	$my_settings_page = new mySettingPage();
