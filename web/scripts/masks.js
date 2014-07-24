/**
 * MASKS
 */
$('.date').mask('99/99/9999', { placeholder:" " });
$('.postcode').mask('99999-999', { placeholder:" " });

$('.volume').priceFormat({
    prefix: '',
    thousandsSeparator: ''
});

$('.weight').priceFormat({
    prefix: '',
    thousandsSeparator: ''
});

$('.money').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
});