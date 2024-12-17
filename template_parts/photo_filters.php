<div class="photo_filters">
    <div class="photo_filters-taxonomy">
        <!-- Catégories -->
        <select class="photo_filters-category custom-select">
            <option value="">Catégories</option>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie',
                'orderby' => 'name',
                'order' => 'ASC',
            ));
            foreach ($categories as $categorie) {
                echo '<option value="' . $categorie->term_id . '">' . $categorie->name . '</option>';
            }
            ?>
        </select>

        <!-- Formats -->
        <select class="photo_filters-format custom-select">
            <option value="">Formats</option>
            <?php
            $formats = get_terms(array(
                'taxonomy' => 'format',
                'orderby' => 'name',
                'order' => 'ASC',
            ));
            foreach ($formats as $format) {
                echo '<option value="' . $format->term_id . '">' . $format->name . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="photo_filters-orderby">
        <!-- Trier par -->
        <select class="photo_filters-order custom-select">
            <option value="ASC">Trier par</option>
            <option value="DESC">À partir des plus récentes</option>
            <option value="ASC">À partir des plus anciennes</option>
        </select>
    </div>
</div>