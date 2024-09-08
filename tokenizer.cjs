const kuromoji = require("kuromoji");

kuromoji.builder({ dicPath: "C:/Users/mario/Desktop/proyectoCareerCross/proyectoCareerCross/node_modules/kuromoji/dict/" }).build(function (err, tokenizer) {
    if (err) {
        console.log("Error al construir el tokenizador:", err);
        return;
    }

    const text = process.argv[2];  // Tomamos el texto como argumento
    const tokens = tokenizer.tokenize(text);

    console.log(JSON.stringify(tokens, null, 2));  // Mostramos los tokens en formato JSON
});
