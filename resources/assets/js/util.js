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