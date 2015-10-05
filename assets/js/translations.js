/**
 * Created by gera on 30.05.15.
 */
$(document).ready(function() {

    var table = $('#translationsTable').dataTable();

    //add new template for row details in our table
    $('td.open').click(function () {
        $.ajax({
            url: "table-content.html",
            cache: false,
            success: function (html) {
                $('div.include').html(html);
            }
        });
    });

    //search filter
    $('.search-in-table').keyup(function () {
        table.fnFilter($(this).val());
    });

    //check checkbox
    $('#translationsTable input[type=checkbox]').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('tr').addClass('selected');
        } else {
            $(this).closest('tr').removeClass('selected');
        }
        if ($('[type="checkbox"]:checked:not("#checkbox0")').length == $('[type="checkbox"]:not("#checkbox0")').length) {
            $('#checkbox0').prop('checked', true);
        } else {
            $('#checkbox0').prop('checked', false);
        }
    });
    //activate button-del when one of the checkboxes choosen
    $('input[type="checkbox"]').on('change', function(){
        if ($('[type="checkbox"]').is(':checked') > 0) {
            $('#delete-selected').removeClass('disabled').addClass('active');
        } else {
            $('#delete-selected').removeClass('active').addClass('disabled');
        }
    });
    //check all
    $('#checkbox0').on('change', function() {
        if($(this).is(":checked")) {
            $('input[type="checkbox"]').each(function() {
                $(this).prop('checked', true).closest('tr').addClass('selected');
            });
        } else {
            $('input[type="checkbox"]').each(function() {
                $(this).prop('checked', false).closest('tr').removeClass('selected');
                $('#delete-selected').removeClass('active').addClass('disabled');
            });
        }
    });

    //"Yes" button to delete choose rows
    $('#continue-btn').click( function() {
        // delete all selected checkboxes row
        $('input[type=checkbox]:checked').each(function(){
            $('tr.row-details').children().remove();
            $('input[type=checkbox]:checked:not("#checkbox0")').closest('tr').remove();
            if ($('#checkbox0').is(':checked')) {
                $(this).prop('checked', false);
                $(this).prop('disabled', true);
            }
            if ($('input[type=checkbox]') > 1) {
                $(this).prop('disabled', false);
            }
        });
        $('#delete-selected').removeClass('active').addClass('disabled');
    });
    //refresh page button
    $('#refresh-page-btn').click( function() {
        location.reload();
    });
});

/*      ggggggggg        */

var app = {

    initialize: function() {
        this.modules();
        this.setUpListeners();
    },

    modules: function() {

    },

    setUpListeners: function() {
        $('form').on('submit', app.submitForm);
        $('form').on('keydown', 'input', app.removeError);
    },

    submitForm: function(e) {
        e.preventDefault();

        var form = $(this);

        if(app.validateForm(form) === false) {
            return false;
        }

        console.log('go in ajax');
    },

    validateForm: function(form) {
        var inputs = form.find('input'),
            valid = true;

        $.each(inputs, function(index, val) {
            var input = $(val),
                val = input.val(),
                formGroup = input.parents('.form-group'),
                label = formGroup.find('label').text().toLowerCase();
            //textError = 'Enter your ' + label;

            if (val.length === 0) {
                formGroup.addClass('has-error').removeClass('has-success');
                valid = false;

            } else {
                formGroup.addClass('has-success').removeClass('has-error');
            }
        });

        return valid;
    },

    removeError: function() {
        $(this).parents('.form-group').removeClass('has-error');
    }
};

app.initialize();
