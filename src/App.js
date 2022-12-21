import "./App.css";
import MainRouter from "./MainRouter";
import { CartContextProvider } from "./pages/context/CartContext";

function App() {
  return (
    <>
    <CartContextProvider>
      <MainRouter />
    </CartContextProvider>
      
    </>
  );
}

export default App;
