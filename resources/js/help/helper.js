export default{
    getValueInputLang(item, input, model =[]){
      var obj = {};
      var code = item.code;
      var foundIndex = model.findIndex(x => x.lang_code == code);
      if(foundIndex >= 0){
        model[foundIndex].content = input;
      }else{
          obj.lang_code = code;
          obj.content = input
          model.push(obj)
      }
      return model;
    }
} 