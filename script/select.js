const gr = $('.js-group');
const choice = new Choices(gr, {
  searchEnabled: false,
  itemSelectText: "",
  shouldSort: false
})
function submitForm() {
        $('.select').submit();
    }