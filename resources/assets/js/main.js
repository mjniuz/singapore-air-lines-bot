import swal from 'sweetalert2';
$(document).ready(function (e) {
    $("input[type=checkbox]").on("click", function (e) {
        let seatVal = $("#seats-value");
        let seatView    = $("#seat-selected");
        let exist       = $("#existing-seats").val();
        let newThis = this;

        if(exist !== ""){
            e.preventDefault();
            swal(
                'Error!',
                'You already checked in, please check you messenger for boarding pass detail',
                'warning'
            );

            return false;
        }

        if(seatVal.val() !== ""){
            swal({
                title: 'Are you sure?',
                text: "Are you sure to change your current seat?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function () {
                $("input[type=checkbox]").each(function() {
                    $(this).prop('checked', false);
                });

                $(newThis).prop('checked', true);
                seatVal.val($(newThis).val());
                seatView.text($(newThis).val());
                swal(
                    'Changed!',
                    'Your seat has been Changed.',
                    'success'
                );
            }).catch(swal.noop);

            return false;
        }

        seatVal.val($(this).val());
        seatView.text($(this).val());

        swal(
            'Selected!',
            'Successfully select the seat',
            'success'
        );
    });

    $("#btn-submit").on("click", function (e) {
        e.preventDefault();

        if($("#seats-value").val() !== ""){
            $("#check-in-form").submit();
        }else{
            swal(
                'Error',
                'Please select your seat',
                'warning'
            );
        }
    });
});