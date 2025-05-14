import React from 'react';

export const Button = ({ children, className, variant, size, asChild, ...props }) => {
  const combinedStyles = `${className || ''}`;

  if (asChild) {
    return <a className={combinedStyles} {...props}>{children}</a>;
  }

  return <button className={combinedStyles} {...props}>{children}</button>;
};