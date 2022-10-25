<?php
get_header();
// Список категорий типа страна
$terms = get_terms( [ 'taxonomy' => 'brand-cat', 'hide_empty' => false ] );
// Получаем список опций для select "Страна" для текущего языка
$countries   = [];
$countries[] = '';
foreach ( $terms as $term ) {
	if ( apply_filters( 'wpml_object_id', $term->term_id, 'brand-cat' ) == substr( get_locale(), 0, 2 ) ) {
		$countries[ $term->name ] = $term->slug;
	}
}
var_dump($countries);
// Атрибуты фильтров
$filters_titles = FILTER_TITLES;
$filters_arr    = array_keys( $filters_titles );
// Аргументы выборки
$auto_args = [
	'post_type'      => 'post',
	'order_by'       => 'ID',
	'order'          => 'DESC',
	'posts_per_page' => 100
];
// Фильтры. Если есть, добавляем в аргументы выборки
// Получаем список фильтров из GET-аргументов
$filters = [];
for ( $i = 1; $i <= 15; $i ++ ) {
	if ( ! empty( get_query_var( 'filter' . (string) $i ) ) ) {
		$filters[] = get_query_var( 'filter' . (string) $i );
	}
}
$urls = [];
// Цикл по списку фильтров
foreach ( $filters as $filter ) {
	list( $filter_key, $filter_value ) = explode( '_', $filter );
	$filter_value = str_replace( $filter_key . '_', '', $filter );

	// Если фильтр по цене или по году
	if ( $filter_key == 'model' ) {
		$auto_args['meta_query'][] =
			[
				'key'     => $filter_key,
				'value'   => $filter_value,
				'compare' => 'IN'
			];
	} // Бренд
    elseif ( $filter_key == 'brand' ) {
		$auto_args['meta_query'][] =
			[
				'key'     => $filter_key,
				'value'   => $filter_value,
				'compare' => 'IN'
			];
	} // Остальные фильтры
	else {
		$auto_args['meta_query'][] =
			[
				'key'     => $filter_key,
				'value'   => join( ',', explode( '-', $filter_value ) ),
				'compare' => 'IN'
			];
	}
}
// Если количество фильтров больше 1, объединяем их.
if ( count( $filters ) > 1 ) {
	$auto_args['meta_query']['relation'] = 'AND';
}
if ( is_front_page() && ( count( $filters ) > 0 ) ) {
	$auto_args['posts_per_page'] = - 1;
}
$autos = new WP_Query( $auto_args );
// Получаем строку фильтров для h1
$filters_h1 = [];
foreach ( $filters_arr as $f_a ) {
	if ( ! empty( get_filter( $filters, $f_a ) ) ) {
		foreach ( get_filter( $filters, $f_a ) as $f_item ) {
			if ( ! empty( get_acf_translated_value( $f_a, $f_item, get_locale() ) ) ) {
				$filters_h1[ $filters_titles[ $f_a ] ][] = get_acf_translated_value( $f_a, $f_item, get_locale() );
			}
		}
	}
}
$filters_h1_str = [];
foreach ( $filters_h1 as $k => $f_h1 ) {
	$filters_h1_str[] = $k . ': ' . implode( ',', $f_h1 );
}
?>

    <main>

        <section class="inn-banner">
			<?= wp_get_attachment_image( get_field( 'background' ), 'full' ) ?>
            <div class="container">
                <div class="blue-block <?= hexCodeToClass( get_field( 'card_color' ) ) ?>">
                    <div class="crumbs">
						<?php
						if ( function_exists( 'yoast_breadcrumb' ) ) {
							doublee_breadcrumbs();
						}
						?>
                    </div>
                    <h1 class="title">
						<?= get_queried_object()->name ?>
                    </h1>
                </div>
                <p class="collapse"><?php get_queried_object()->description ?></p>
            </div>
        </section>

        <section class="prod-catalog">
            <div class="container">
                <div class="row ">
                    <form class="col-lg-3">
                        <div class="filt-btn">
                            <img src="images/dest/filter.png" alt="">
                            <span>
                            Фільтр
                        </span>
                        </div>
                        <div class="filter">
                            <div class="filter-box">
                                <div class="title">
                                    КАТЕГОРІЇ
                                </div>
                                <ul class="categories">
                                    <li>
                                        <a href="#">Моторні мастила для грузових двигунів</a>
                                    </li>
                                    <li>
                                        <a href="#">Моторні мастила для легкових двигунів</a>
                                    </li>
                                    <li>
                                        <a href="#">Трансмісійні мастила</a>
                                    </li>
                                    <li>
                                        <a href="#">Вакуумні мастила</a>
                                    </li>
                                    <li>
                                        <a href="#">Компресорні мастила</a>
                                    </li>
                                    <li>
                                        <a href="#">ЗОР</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter-box">
                                <div class="title">
                                    КАТЕГОРІЇ
                                </div>
                                <div class="check-wrapper">
                                    <label for="d">
                                        <div class="check-inn">
                                            <input id="d" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Petronas
                                        </span>
                                    </label>
                                    <label for="d1">
                                        <div class="check-inn">
                                            <input id="d1" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            ScandiOil
                                        </span>
                                    </label>
                                    <label for="d2">
                                        <div class="check-inn">
                                            <input id="d2" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Petronas
                                        </span>
                                    </label>
                                    <label for="d3">
                                        <div class="check-inn">
                                            <input id="d3" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            CRC
                                        </span>
                                    </label>
                                    <label for="d4">
                                        <div class="check-inn">
                                            <input id="d4" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            NRG
                                        </span>
                                    </label>
                                    <label for="d5">
                                        <div class="check-inn">
                                            <input id="d5" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Apar
                                        </span>
                                    </label>
                                    <label for="d6">
                                        <div class="check-inn">
                                            <input id="d6" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                               Nettuno
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-box">
                                <div class="title-big">
                                    Фільтр
                                </div>
                                <div class="title-small">
                                    Категорія
                                </div>
                                <div class="check-wrapper">
                                    <label for="d7">
                                        <div class="check-inn">
                                            <input id="d7" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            SAE в’язкість
                                        </span>
                                    </label>
                                </div>
                                <div class="title-small">
                                    Специфікація
                                </div>
                                <div class="check-wrapper">

                                    <label for="d7">
                                        <div class="check-inn">
                                            <input id="d7" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                           Приклад
                                        </span>
                                    </label>

                                </div>
                                <div class="title-small">
                                    Тип
                                </div>
                                <div class="check-wrapper">
                                    <label for="d8">
                                        <div class="check-inn">
                                            <input id="d8" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Мінеральне
                                        </span>
                                    </label>
                                    <label for="d9">
                                        <div class="check-inn">
                                            <input id="d9" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Синтетика
                                        </span>
                                    </label>
                                    <label for="d10">
                                        <div class="check-inn">
                                            <input id="d10" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Напівсинтетика
                                    </span>
                                    </label>
                                </div>

                                <div class="title-small">
                                    ФАСОВКА
                                </div>
                                <div class="check-wrapper">
                                    <label for="d11">
                                        <div class="check-inn">
                                            <input id="d11" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Бочка
                                        </span>
                                    </label>
                                    <label for="d12">
                                        <div class="check-inn">
                                            <input id="d12" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            Каністра
                                        </span>
                                    </label>
                                    <label for="d13">
                                        <div class="check-inn">
                                            <input id="d13" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            200л
                                        </span>
                                    </label>
                                    <label for="d14">
                                        <div class="check-inn">
                                            <input id="d14" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            60л
                                        </span>
                                    </label>
                                    <label for="d15">
                                        <div class="check-inn">
                                            <input id="d15" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            5л
                                        </span>
                                    </label>
                                    <label for="d16">
                                        <div class="check-inn">
                                            <input id="d16" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            4л
                                        </span>
                                    </label>
                                    <label for="d17">
                                        <div class="check-inn">
                                            <input id="d17" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            3л
                                        </span>
                                    </label>
                                    <label for="d17">
                                        <div class="check-inn">
                                            <input id="d17" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            1л
                                        </span>
                                    </label>
                                    <label for="d18">
                                        <div class="check-inn">
                                            <input id="d18" type="checkbox">
                                            <span></span>
                                        </div>
                                        <span>
                                            0,5л
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-9">
                        <div class="row prod-boxes">
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 d-sm-none">
                                <section class="consult">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/images/dest/bg-cons.jpg" alt="" class="bg">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h2 class="title">
                                                    Потрібна консультація? Ми завжди на зв’язку!
                                                </h2>
                                                <a href="" class="btn arr">
                                                    Дізнатись більше
                                                </a>
                                            </div>
                                            <div class="col-lg-6">
						<span>
							Ви можете телефонувати нам при виникненні будь-яких питань
						</span>
                                                <a href="tel:380507010070" class="tel">
                                                    +38 (050) 70-100-70

                                                </a>
                                                <a href="tel:380987020070" class="tel">
                                                    +38 (098) 70-200-70
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 d-sm-none">
                                <section class="consult w-btn">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/images/dest/bg-cons.jpg" alt="" class="bg">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h2 class="title">
                                                    Шукаєте наш офіс у своєму місті?
                                                </h2>
                                                <a href="" class="btn arr">
                                                    Дізнатись більше
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>
                            <div class="p-box col-lg-4 col-md-6 col-12">
                                <div class="inn">
                                    <a class="a-img" href="#">
                                        <img src="images/dest/product.jpg" alt="">
                                    </a>
                                    <a href="#" class="title">
                                        PETRONAS Syntium 5000 XS 5W30
                                    </a>
                                    <div class="sub">
                                        ЗАСТОСУВАННЯ
                                    </div>
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                                    </p>
                                    <a href="#" class="bt-n">
                                        До товару
                                    </a>
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="pagination">
                                    <li>
                                        <a class="active" href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#">5</a>
                                    </li>
                                    <li class="d-none d-md-flex">
                                        <a href="#">6</a>
                                    </li>
                                    <li class="d-none d-md-flex">
                                        <a href="#">7</a>
                                    </li>
                                    <li class="arrow">
                                        <a href="#">
                                            <img src="images/dest/arr9.svg" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="phones-contact no-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="inn">
                            <div class="title">
                                Потрібна консультація?
                            </div>
                            <div class="phones">
                                <a href="tel:380507010070">+38 (050) 70-100-70
                                </a>
                                <a href="tel:380987020070">+38 (098) 70-200-70</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="inn">
                            <a href="#" class="request modal-open">
                                Відправити запит
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- #main -->

<?php
get_footer();
