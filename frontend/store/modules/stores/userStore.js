import { useCrud } from "@store/utils";
import {apiRequest} from "../../axios";

const model = "users";

const { name, store } = useCrud(model);

store.actions.fetchProfile = ({ commit }, id) => {
    return new apiRequest(
        `${model}/profile`,
        'GET',
    )
}

store.actions.postuler = ({ commit }, idOffer) => {
    return new apiRequest(
        `${model}/postuler/${idOffer}`,
        'PATCH',
    )
}

store.actions.depostuler = ({ commit }, idOffer) => {
    return new apiRequest(
        `${model}/depostuler/${idOffer}`,
        'PATCH',
    )
}

export default {
    name,
    store,
}
