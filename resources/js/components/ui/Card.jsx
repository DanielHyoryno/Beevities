import React from 'react';

export const Card = ({ children, className, ...props }) => (
    <div className={className || 'default-class'} {...props}>
      {children}
    </div>
  );
  
  export const CardContent = ({ children, className, ...props }) => (
    <div className={className || ''} {...props}>
      {children}
    </div>
  );
  