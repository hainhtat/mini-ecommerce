import React, { useContext } from "react";
import Master from "./layout/Master";
import CartContext from "./context/CartContext";

export default function Cart() {
  const cart = useContext(CartContext);

  //remove item from cart
    const removeItem = (id) => {
        cart.setCart(cart.cart.filter(item => item.id !== id));

    }

  return (
    <>
      <Master>
        <table className="table table-striped">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            {cart.cart.map((item, index) => {
              return (
                <tr key={index}>
                  <td>
                    <img
                      src={`http://localhost:8000/images/${item.image}`}
                      alt={item.name}
                      width="100"
                      className="img img-thumbnail"
                    />
                  </td>
                  <td>{item.name}</td>
                  <td>{item.price}</td>
                  <td>
                    {item.count}
                  </td>
                  <td>
                    <button className="btn btn-danger" onClick={() => removeItem(item.id)}>
                        <span className="fas fa-trash"></span>
                    </button>
                  </td>
                </tr>
              );
            })}

        <tr>
            <td>
                Total
            </td>
            <td>
                {cart.cart.reduce((total, item) => {
                    return total + (item.price * item.quantity);
                }
                , 0)}
            </td>
        </tr>
          </tbody>
        </table>

        <button className="btn btn-danger">Order Now</button>
      </Master>
    </>
  );
}
