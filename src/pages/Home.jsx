import React, { useEffect, useState, useContext } from "react";
import Master from "./layout/Master.jsx";
import Axioss from "../config/Axioss";
import Loader from "./components/Loader.jsx";
import CartContext from "./context/CartContext.jsx";

export default function Home() {
  const [loader, setLoader] = React.useState(true);
  const [data, setData] = useState({ data: [] });
  const [category, setCategory] = useState([]);

  //category state
  const [selectedCategory, setSelectedCategory] = useState("");

  //paginate
  const [currentPage, setCurrentPage] = useState(1);

  const [api, setApi] = useState("/watch");
  useEffect(() => {
    Axioss.get(api).then((res) => {
      setLoader(false);
      setData(res.data.data);
    });

    Axioss.get("/category").then((res) => {
      setLoader(false);
      setCategory(res.data.data);
    });
  }, [api]);

  //context
  const cart = useContext(CartContext);

  //category filter
  const renderProductByCategory = (id) => {
    setCurrentPage(1);
    setSelectedCategory(id);
    setApi(`/watch?category_id=${id}`);

  }


  //render next page
  const renderNextPage = () => {
    setLoader(true);
    setCurrentPage(currentPage + 1);
    const page = currentPage + 1;
    if(selectedCategory === null){
      setApi(`/watch?page=${page}`);
      setLoader(false);
    } else {
      setApi(`/watch?category_id=${selectedCategory}&page=${page}`);
      setLoader(false);
    }
  }

  //render prev page
  const renderPrevPage = () => {
    setLoader(true);
    setCurrentPage(currentPage - 1);
    const page = currentPage - 1;
    if(selectedCategory === null){
      setApi(`/watch?page=${page}`);
      setLoader(false);
    } else {
      setApi(`/watch?category_id=${selectedCategory}&page=${page}`);
      setLoader(false);
    }
  }

  //add to cart
  const addToCart = (item) => {
    const existItem = cart.cart.find((item) => item.id === cart.item.id);
    if (existItem) {
      existItem.count += 1;
    } else {
      cart.setCart([...cart.cart, { ...item, count: 1 }]);
    }  
  }
  return (
    <Master>
      {loader ? (
        <Loader />
      ) : (
        <div className="container">
          <div className="row">
            <div className="col-md-12">
              <div className="card p-3">
                <div>
                  {category.map((item) => (
                    <span
                      className={
                        selectedCategory === item.id
                          ? "btn btn-dark"
                          : "btn btn-outline-dark"
                      }
                      key="item.id"
                      style={{ marginRight: 3 }}
                      onClick={() => renderProductByCategory(item.id)}
                    >
                      {item.name}
                    </span>
                  ))}
                </div>
              </div>
            </div>
          </div>
          <div className="row mt-2">
            <div className="col-md-12 mb-3">
              <button
                className="btn btn-primary"
                disabled={data.prev_page_url === null ? true : false}
                onClick = {() => renderPrevPage()}
              >
                <span className="fas fa-arrow-left"></span>
              </button>

              <button
                className="btn btn-primary ms-2"
                disabled={data.next_page_url === null ? true : false}
                onClick = {() => renderNextPage()}
              >
                <span className="fas fa-arrow-right"></span>
              </button>
            </div>
            {data.data.map((item) => {
              return (
                <div className="col-md-3" key={item.id}>
                  <div className="card" width="18rem">
                    <img
                      src={`http://localhost:8000/images/${item.image}`}
                      alt=""
                      className="card-img-top img-fluid"
                      width="10rem"
                    />
                    <div className="card-body">
                      <h4 className="text-center card-header">{item.name}</h4>
                      <div className="d-flex justify-content-between mt-3">
                        <span className="btn btn-sm btn-outline-warning">
                          MMK {item.price}
                        </span>
                        <span className="btn btn-sm btn-danger" onClick={()=>addToCart(item)}>
                          Add to Cart
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      )}
    </Master>
  );
}
