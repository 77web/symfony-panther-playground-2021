$(document).ready(() => {
    let typeSelect = $('#type');
    typeSelect.change(updateVendors);
    $.ajax('/vendorTypes', {
        success: (response) => {
            for (let i = 0; i < response.length; i++) {
                let type = response[i];
                typeSelect.append($('<option>' + type + '</option>'));
            }
        }
    })
});

function updateVendors() {
    let type = $('#type').val();
    let vendorSelect = $('#vendor');
    vendorSelect.children().remove().end();
    if (type) {
        $.ajax('/vendors/' + type, {
            success: (response) => {
                for (let i = 0; i < response.length; i++) {
                    let vendor = response[i];
                    vendorSelect.append($('<option value="' + vendor.name + '">' + vendor.caption + '</option>'));
                }
                vendorSelect.removeAttr('disabled');
            }
        });
    }
}

