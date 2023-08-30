$(document).ready(function() {

    var pond = $('input[name=pond]:checked').val();
    showFishBlock(pond);

    $(document).on('click', '.pond-class', function() {

        var pond = $('input[name=pond]:checked').val();
        showFishBlock(pond);

    });

    function showFishBlock(pond) {
        if (pond == 1) {
            $('.fish-culti-div').show();
        } else {
            $('.fish-culti-div').hide();
        }
    }

    var poultry = $('input[name=poultry_shed]:checked').val();
    showPoultryLiveBlock(poultry);

    $(document).on('click', '.poultry-shed', function() {

        var poultry = $('input[name=poultry_shed]:checked').val();
        showPoultryLiveBlock(poultry);
    });

    function showPoultryLiveBlock(poultry) {
        if (poultry == 1) {
            $('.poultry-live-div').show();
        } else {
            $('.poultry-live-div').hide();
        }
    }

    var animal = $('input[name=animal_shed]:checked').val();
    showAnimalLiveBlock(animal);

    $(document).on('click', '.animal-shed', function() {

        var animal = $('input[name=animal_shed]:checked').val();
        showAnimalLiveBlock(animal);
    });

    function showAnimalLiveBlock(animal) {
        if (animal == 1) {
            $('.animal-live-div').show();
        } else {
            $('.animal-live-div').hide();
        }
    }

    // CATTLE SHED

    var cattle = $('input[name=cattle_shed]:checked').val();
    showCattleLiveBlock(cattle);

    $(document).on('click', '.cattle-shed', function() {

        var cattle = $('input[name=cattle_shed]:checked').val();
        showCattleLiveBlock(cattle);
    });

    function showCattleLiveBlock(cattle) {
        if (cattle == 1) {
            $('.cattle-live-div').show();
        } else {
            $('.cattle-live-div').hide();
        }
    }

    // GOAT/PIG SHED

    var goat = $('input[name=goat_shed]:checked').val();
    showGoatLiveBlock(goat);

    $(document).on('click', '.goat-shed', function() {

        var goat = $('input[name=goat_shed]:checked').val();
        showGoatLiveBlock(goat);
    });

    function showGoatLiveBlock(goat) {
        if (goat == 1) {
            $('.goat-live-div').show();
        } else {
            $('.goat-live-div').hide();
        }
    }

    var compost = $('input[name=compost_pit]:checked').val();
    showPitNoBlock(compost);

    $(document).on('click', '.compost-pit', function() {

        var compost = $('input[name=compost_pit]:checked').val();
        showPitNoBlock(compost);
    });

    function showPitNoBlock(compost) {
        if (compost == 1) {
            $('.compost-pit-div').show();
        } else {
            $('.compost-pit-div').hide();
        }
    }

    var land = $('input[name=land]:checked').val();
    showAgriLandBlock(land);

    $(document).on('click', '.land-class', function() {

        var land = $('input[name=land]:checked').val();
        showAgriLandBlock(land);
    });

    function showAgriLandBlock(land) {
        if (land == 1) {
            $('.agri-land-div').show();
        } else {
            $('.agri-land-div').hide();
        }
    }

    var agriLand = $('input[name=agri_land]:checked').val();
    showLandSizeBlock(agriLand);

    $(document).on('click', '.agri-land-class', function() {

        var agriLand = $('input[name=agri_land]:checked').val();
        showLandSizeBlock(agriLand);
    });

    function showLandSizeBlock(agriLand) {
        if (agriLand == 1) {
            $('.land-size-div').show();
        } else {
            $('.land-size-div').hide();
        }
    }

})