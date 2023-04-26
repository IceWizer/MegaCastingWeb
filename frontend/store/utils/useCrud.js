import crudBase from "./crud";

export default (modelName) =>
{
    const store = crudBase(modelName);

    return {
        name: store.name,
        store: store
    }
}
