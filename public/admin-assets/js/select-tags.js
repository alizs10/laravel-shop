$("#input_tags").selectize({
    delimiter: ",",
    persist: false,
    create: function (input) {
      return {
        value: input,
        text: input,
      };
    },
  });