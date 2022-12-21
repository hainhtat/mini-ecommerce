import React from "react";

export default function Loader() {
  return (
    <div className="d-flex justify-content-center p-5">
      <div className="spinner-grow text-primary" role="status">
        <span className="sr-only"></span>
      </div>
    </div>
  );
}
