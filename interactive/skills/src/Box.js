import React, { Fragment } from "react";
import PropTypes from "prop-types";

const propTypes = {
  name: PropTypes.string,
  x: PropTypes.number,
  y: PropTypes.number,
  r: PropTypes.number,
  width: PropTypes.number,
  height: PropTypes.number
};

const Box = props => {
  const { name, x, y, r, width, height } = props;

  return (
    <Fragment>
      {y ? <div className="box" style={{
        'transform': `translate3d(${x}px, ${y}px, 0) rotate(${r}deg)`,
        'width': `${width}px`,
        'height': `${height}px`
      }}>{name}</div> : null}
    </Fragment>
  );
};

Box.propTypes = propTypes;

export default Box;
