import React, { Fragment } from "react";
import Boxes from "./Boxes";

const Hero = props => {
  return (
    <Fragment>
      <section className="hero">
        <h1>
          Hi! I&#39;m Joan, a Front-end Engineering Manager and Creative Technologist who makes tech <i>easy as candy</i>
        </h1>
        <h2>These are some of my current tools</h2>
        <Boxes />
      </section>
    </Fragment>
  );
};

export default Hero;
