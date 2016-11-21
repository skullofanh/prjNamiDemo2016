<?php

class WNGAdminUi {
	var $file_path;

	public function __construct( $path){
		$this->file_path = $path;
		$this->setUi();
	}

	public function setUi(){
		register_setting(WNG::OPTIONS, WNG::OPTIONS, array( &$this, 'validate' ));
		add_settings_section('main_section', '表示設定', array(&$this,'section_text_fn'), $this->file_path);
		add_settings_field('wng_title', 'タイトル', array(&$this,'setting_title'), $this->file_path, 'main_section');
		add_settings_field('wng_background_color', 'タイトル背景色', array(&$this,'setting_background_color'), $this->file_path, 'main_section');
		add_settings_field('wng_font_color', 'タイトル文字色', array(&$this,'setting_font_color'), $this->file_path, 'main_section');
		add_settings_field('wng_content_type', '表示するコンテンツ', array(&$this,'setting_content_type'), $this->file_path, 'main_section');
		add_settings_field('wng_category_name', 'カテゴリーのスラッグ', array(&$this,'setting_category_name'), $this->file_path, 'main_section');
		add_settings_field('wng_orderby', '表示順序', array(&$this,'setting_orderby'), $this->file_path, 'main_section');
		add_settings_field('wng_number', '表示件数', array(&$this,'setting_number'), $this->file_path, 'main_section');
		add_settings_field('wng_newmark', 'NEW!マーク表示期間', array(&$this,'setting_newmark'), $this->file_path, 'main_section');
		add_settings_field('wng_latest_new', '最新記事にNEW!マークをつける', array(&$this,'setting_latest_new'), $this->file_path, 'main_section');
		add_settings_field('wng_dateformat', '日付のフォーマット', array(&$this,'setting_dateformat'), $this->file_path, 'main_section');
		add_settings_field('wng_postlist_url', '一覧ページのurl', array(&$this,'setting_postlist_url'), $this->file_path, 'main_section');
	}

	public function show_admin_page() {
		$file = $this->file_path;
		$option_name = WNG::OPTIONS;
		$shortcode = "[" . WNG::SHORTCODE . "]";
		include_once( dirname(__FILE__) . '/admin-view.php');
		$info = new WhatsNewInfo();
		include_once( dirname(__FILE__) . '/whatsnew-view.php');
	}

	private function is_color( $code ) {
		if( preg_match('/^#[a-f0-9]{6}$/i', $code ) ){
			return true;
		}
		return false;
	}

	function validate($input) {
		$this->is_color( $input['wng_font_color'] ) or $input['wng_font_color'] = "#000";
		$this->is_color( $input['wng_background_color'] ) or $input['wng_background_color'] = "#f1f5f5";
		if ( !is_numeric( $input['wng_number']) || $input['wng_number'] < 1 || $input['wng_number'] > 30){
			$input['wng_number'] = 10;
		}
		if ( !is_numeric( $input['wng_newmark']) || $input['wng_newmark'] < 0 || $input['wng_newmark'] > 30){
			$input['wng_newmark'] = 0;
		}
		$input['wng_title'] = esc_html( $input['wng_title'] );
		$input['wng_category_name'] = trim(esc_html( $input['wng_category_name'] ));
		$input['wng_postlist_url'] = esc_url( $input['wng_postlist_url'] );
		return $input;
	}

	function  section_text_fn() {
	}

	function setting_title() {
		$options = WNG::get_option();
		$value = $options["wng_title"];
		echo "<input id='wng_title' name='whats_new_options[wng_title]' size='40' type='text' value='{$value}' />";
	}

	function setting_postlist_url() {
		$options = WNG::get_option();
		$value = $options["wng_postlist_url"];
		echo "<input id='wng_postlist_url' name='whats_new_options[wng_postlist_url]' size='40' type='text' value='{$value}' />";
	}


	function setting_background_color() {
		$options = WNG::get_option();
		$value = $options["wng_background_color"];
		echo "<input id='wng_background_color' name='whats_new_options[wng_background_color]' size='10' type='text' value='{$value}' />";
	}

	function setting_font_color() {
		$options = WNG::get_option();
		$value = $options["wng_font_color"];
		echo "<input id='wng_font_color' name='whats_new_options[wng_font_color]' size='10' type='text' value='{$value}' />";
	}

	function setting_newmark() {
		$options = WNG::get_option();
		$value = $options["wng_newmark"];
		echo "<input id='wng_newmark' name='whats_new_options[wng_newmark]' size='2' type='text' value='{$value}' />日間";
	}

	function setting_latest_new() {
		$options = WNG::get_option();
		$checked = (isset($options["wng_latest_new"]) && $options["wng_latest_new"]) ? $checked = ' checked="checked" ': "";
		echo "<input id='wng_latest_new' name='whats_new_options[wng_latest_new]' type='checkbox' '{$checked}' />";
	}

	function setting_category_name() {
		$options = WNG::get_option();
		$value = $options["wng_category_name"];
		echo "<input id='wng_category_name' name='whats_new_options[wng_category_name]' size='40' type='text' value='{$value}' />";
	}

	function  setting_number() {
		$options = WNG::get_option();
		$value = $options["wng_number"];
		echo "<input id='wng_number' name='whats_new_options[wng_number]' size='2' type='text' value='{$value}' />個";
	}

	function setting_content_type() {
		$options = WNG::get_option();
		$items = array("投稿", "固定ページ", "投稿＋固定ページ");
		foreach($items as $item) {
			$checked = ($options['wng_content_type']==$item) ? ' checked="checked" ' : '';
			echo "<label><input {$checked} value='{$item}' name='whats_new_options[wng_content_type]' type='radio' /> $item</label><br />";
		}
	}

	function setting_orderby() {
		$options = WNG::get_option();
		$items = array("公開日順", "更新日順");
		foreach($items as $item) {
			$checked = ($options['wng_orderby']==$item) ? ' checked="checked" ' : '';
			echo "<label><input {$checked} value='{$item}' name='whats_new_options[wng_orderby]' type='radio' /> $item</label><br />";
		}
	}

	function setting_dateformat() {
		$options = WNG::get_option();
		$items = array("Y年n月j日", "Y-m-d", "Y/m/d", "j/n/Y", "n/j/Y");
		echo "<select id='wng_dateformat' name='whats_new_options[wng_dateformat]'>";
		foreach($items as $item) {
			$selected = ($options['wng_dateformat']==$item) ? 'selected="selected"' : '';
			echo "<option value='$item' $selected>$item</option>";
		}
		echo "</select>";
	}
}
