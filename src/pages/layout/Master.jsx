import React, { useContext }from "react";
import { Link } from "react-router-dom";
import CartContext from "../context/CartContext";

//context

const Master = ({ children }) => {
  const cart = useContext(CartContext);
  return (
    <>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark container-fluid">
        <div className="container">
          <Link className="navbar-brand" to="/">
            Watch Store
          </Link>
          <button
            className="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="navbar-toggler-icon" />
          </button>
          <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav">
              <li className="nav-item active">
                <Link to="/" className="nav-link">
                  Home
                </Link>
              </li>
              <li className="nav-item">
                <Link to="/about" className="nav-link">
                  About
                </Link>
              </li>
              <li className="nav-item">
                <Link to="/cart" className="nav-link">
                  Cart
                  <span className="badge badge-pill badge-danger">{ cart.cart.length}</span>
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div className="container mt-3">
        <div className="p-5">{children}</div>
      </div>
    </>
  );
};

export default Master;
