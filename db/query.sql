use ecommerce;
-- LẤY RA DOANH SỐ CỦA SẢN PHẨM THEO THÁNG
SELECT product_name, SUM(quantity) AS sold, SUM(amount) AS turnover,MONTH(placed_on) FROM product
INNER JOIN order_detail  ON  product.product_id=  order_detail.product_id
INNER JOIN orders  ON  orders.order_id =  order_detail.order_id
WHERE MONTH(placed_on) = 6
GROUP BY order_detail.product_id
ORDER BY order_detail.amount DESC;

-- LẤY RA TOP 10 SẢN PHẨM CÓ DOANH SỐ BÁN CHẠY NHẤT
SELECT product.product_id, product.product_name, product.price, product.product_description,stock, SUM(order_detail.quantity) AS sold, SUM(amount) FROM product 
INNER JOIN order_detail ON product.product_id = order_detail.product_id
group by product.product_name
ORDER BY order_detail.amount
DESC limit 0,10;


SELECT SUM(price*sum(quantity)), order_detail.product_id,product.product_name from order_detail
inner join product on product.product_id =  order_detail.product_id;
 

select * from orders
inner join product on order_detail.product_id = product.product_id
 group by product.product_id




-- LẤY RA DANH SACH WISH LIST CỦA 1 TÀI KHOẢN
SELECT * from wish_list_detail 
INNER JOIN wish_list ON wish_list.wish_list_id = wish_list_detail.wish_list_id 
JOIN product ON wish_list_detail.product_id = product.product_id
WHERE user_id = 'quanghiep031'
group by wish_list_detail.product_id;


SELECT * FROM users
INNER JOIN user_role ON users.role_id = user_role.role_id
WHERE user_id NOT IN (SELECT user_id FROM users WHERE role_id= 1 )
