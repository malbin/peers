// Common JS between Dashboard and Signup pages for Jobs

$(function(){
    // Add Job: Type-ahead
    $('#JobTitle').smartAutoComplete({
        source: BASEURL + 'jobs/autocomplete',
        typeAhead: true,
        resultsContainer: false
    });
    $('#EmployerName').smartAutoComplete({
        source: BASEURL + 'employers/autocomplete',
        typeAhead: true,
        resultsContainer: false
    });
    $('#JobCountryId').change(function(){
        if ($(this).val()) {
            $.get(BASEURL + 'jobs/location/' + $(this).val() + '/' + $(this).data('location-fields-type'), function(data){
                $('#add-job-location-fields').html(data);
            });
        } else {
            $('#add-job-location-fields').html('');
        }
    });
});