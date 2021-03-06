export const stringDifference = (a, b) => {
    let difference = "";
    if (a.length === b.length) {
        return difference;
    }

    const longer = String(a.length > b.length ? a : b);
    const shorter = String(a.length > b.length ? b : a);

    let i;
    for (i = 0; i < shorter.length; i++) {
        if(longer[i] !== shorter[i]) {
            break;
        }
    }

    return longer.substring(i);
};

export const convertIngredientAmount = (string, factor) => {
    let amount = parseInt(String(string).replace(",", "."));
    let unit = stringDifference(amount, string);

    let newAmount = amount * factor;
    return newAmount + unit;
};

export const snakeToCamel = (s) => {
    return s.replace(/(\_\w)/g, function(m){return m[1].toUpperCase();});
};

export const deepFor = (object, closure) => {
    for(let key in object) {
        let property = object[key];
        if(typeof property === "object") {
            deepFor(property, closure);
        }
        property = closure(object, key);
    }
};