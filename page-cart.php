<?php /* Template Name: Cart Page */ ?>
<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        <div class="cart-page-wrapper">
            
            <h1 class="section-title"><?php the_title(); ?></h1>
            
            <div id="cart-container">
                <p>Завантаження товарів...</p>
            </div>
            
            <div id="order-form-wrapper">
                <div class="form-container">
                    <h2 class="section-title">Оформлення замовлення</h2>
                    <?php 
                    // Вставь сюда ID своей формы вместо "1"
                    gravity_form( 1, false, false, false, '', true ); 
                    ?>
                </div>
            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>