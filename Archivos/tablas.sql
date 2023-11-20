/*Se crea la base de datos */
drop schema if exists valhalla;
drop user if exists ragnar;
CREATE SCHEMA valhalla ;

/*Se crea un usuario para la base de datos*/
create user 'ragnar' identified by 'valhalla123';

/*Se asignan los prvilegios*/
grant all privileges on valhalla.* to 'ragnar';
flush privileges;

/* la tabla de categoria contiene categorias de productos*/
create table valhalla.categoria (
  id_categoria INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(30) NOT NULL,
  ruta_imagen varchar(1024),
  activo bool,
  PRIMARY KEY (id_categoria))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table valhalla.producto (
  id_producto INT NOT NULL AUTO_INCREMENT,
  id_categoria INT NOT NULL,
  descripcion VARCHAR(30) NOT NULL,  
  detalle VARCHAR(1600) NOT NULL, 
  precio double,
  existencias int,  
  ruta_imagen varchar(1024),
  activo bool,
  PRIMARY KEY (id_producto),
  foreign key fk_producto_caregoria (id_categoria) references categoria(id_categoria)  
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table valhalla.rol (
  id_rol INT NOT NULL AUTO_INCREMENT,
  nombre varchar(20),
  PRIMARY KEY (id_rol)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

/*Se crea la tabla de clientes*/
CREATE TABLE valhalla.usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  id_rol INT,
  username varchar(20) NOT NULL,
  password varchar(512) NOT NULL,
  nombre VARCHAR(20) NOT NULL,
  apellidos VARCHAR(30) NOT NULL,
  correo VARCHAR(25) NULL,
  telefono VARCHAR(15) NULL,
  ruta_imagen varchar(1024),
  PRIMARY KEY (`id_usuario`),
  foreign key fk_usuario_rol(id_rol) references rol(id_rol))  
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table valhalla.factura (
  id_factura INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  fecha date,  
  total double,
  estado int,
  PRIMARY KEY (id_factura),
  foreign key fk_factura_usuario (id_usuario) references usuario(id_usuario)  
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table valhalla.venta (
  id_venta INT NOT NULL AUTO_INCREMENT,
  id_factura INT NOT NULL,
  id_producto INT NOT NULL,
  precio double, 
  cantidad int,
  PRIMARY KEY (id_venta),
  foreign key fk_ventas_factura (id_factura) references factura(id_factura),
  foreign key fk_ventas_producto (id_producto) references producto(id_producto) 
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


insert into valhalla.rol (id_rol, nombre) values
 (1,'Dueño'), (2,'Administrador'), (3,'Usuario');

/*Se insertan 3 registros del usuario*/
INSERT INTO valhalla.usuario (id_usuario, id_rol,username,password,nombre, apellidos, correo, telefono,ruta_imagen) VALUES 
(1, 1,'juan','$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.','Juan', 'Castro Mora',    'jcastro@gmail.com',    '4556-8978', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Juan_Diego_Madrigal.jpg/250px-Juan_Diego_Madrigal.jpg'),
(2, 2,'rebeca','$2a$10$GkEj.ZzmQa/aEfDmtLIh3udIH5fMphx/35d0EYeqZL5uzgCJ0lQRi','Rebeca',  'Contreras Mora', 'acontreras@gmail.com', '5456-8789','https://upload.wikimedia.org/wikipedia/commons/0/06/Photo_of_Rebeca_Arthur.jpg'),
(3, 3,'pedro','$2a$10$koGR7eS22Pv5KdaVJKDcge04ZB53iMiw76.UjHPY.XyVYlYqXnPbO','Pedro', 'Mena Loria',     'lmena@gmail.com',      '7898-8936','https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Eduardo_de_Pedro_2019.jpg/480px-Eduardo_de_Pedro_2019.jpg?20200109230854');

/*Se insertan 3 categorias de productos*/
INSERT INTO valhalla.categoria (id_categoria,descripcion,ruta_imagen,activo) VALUES
('1','Procesadores', 'https://cdn.discordapp.com/attachments/1132040104370769920/1173704033400258661/upc.png?ex=6564ec0f&is=6552770f&hm=b2b6282c66b76c89cfa30de8bd73765d7999880e685a999e435cebf208fdaedb&',   true),
('2','Tarjetas de Video', 'https://cdn.discordapp.com/attachments/1132040104370769920/1173704034062958663/gpu.png?ex=6564ec10&is=65527710&hm=dee11e270d7ff1cf116cf1346b171b6472b9bb10c9db3e4cadbbc51fe387b934&',   true),
('3','Tarjetas Madre', 'https://cdn.discordapp.com/attachments/1132040104370769920/1173704032779509905/tarjeta-madre.png?ex=6564ec0f&is=6552770f&hm=fbfbc842254adc7d14311add33c9acab53fa5ea4bdb51d0b02b6b9bdf5284bae&',   true),
('4','Fuente de Alimentacion', 'https://cdn.discordapp.com/attachments/1132040104370769920/1173704032490094622/fuente-de-alimentacion.png?ex=6564ec0f&is=6552770f&hm=5551df6d0cf6d5000f0ee5a3575d531cd965dad516605817dcfb13de2fa15430&',   true),
('5','Ram', 'https://cdn.discordapp.com/attachments/1132040104370769920/1173704033685479474/ram.png?ex=6564ec0f&is=6552770f&hm=88b25f6a62796bf9afdc4a26a2222217006eef9615db6a77d6bbf2f3024d6d68&',   true),

('6','Monitores', 'https://cdn.discordapp.com/attachments/1132040104370769920/1169444928707895466/vr.png?ex=65556d76&is=6542f876&hm=70ef784ac10b662fd5b438091d915d582bee0b297c1280ef7904b3728f2a5960&',   true), 
('7','Audifonos','https://cdn.discordapp.com/attachments/1132040104370769920/1169444929056030801/auriculares.png?ex=65556d76&is=6542f876&hm=152f315cb421425f71c99502354fdd1d939ccf5ede7630a05fee411e144c8219&',true),
('8','Teclados', 'https://cdn.discordapp.com/attachments/1132040104370769920/1169444929467068566/teclado.png?ex=65556d76&is=6542f876&hm=5d09eb3e357583a496bd9af24cccab233d4eedfe62614fba3b70a02478bd8582&',   true),
('9','Mouse','https://cdn.discordapp.com/attachments/1132040104370769920/1169444929714528386/raton-inalambrico.png?ex=65556d76&is=6542f876&hm=cccbf2cff1fd699b01e81588320ef7f5bac5e9fa89c87b5a89247b61fefb81ef&', true);


/*Se insertan 4 productos por categoria */
INSERT INTO valhalla.producto (id_producto,id_categoria,descripcion,detalle,precio,existencias,ruta_imagen,activo) VALUES
(1,1,'Monitor AOC 19','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',23000,5,'https://c.pxhere.com/images/ec/fd/d67b367ed6467eb826842ac81d3b-1453591.jpg!d',true),
(2,1,'Monitor MAC','Quisque in ridiculus scelerisque platea accumsan libero sem vel, mi cras metus cubilia tempor conubia fermentum volutpat gravida, maecenas semper sodales potenti turpis enim dapibus. Volutpat accumsan vivamus dignissim blandit vel eget posuere donec id, tempus sagittis aliquam erat luctus ornare aptent cubilia aliquet proin, ultrices ante pretium gravida sed vitae vestibulum aenean. Eleifend nascetur conubia ornare purus a eget at metus est risus natoque, elementum dis vulputate sociosqu integer ut ad nisl dui molestie.',27000,2,'https://c.pxhere.com/photos/17/77/Art_Calendar_Cc0_Creative_Design_High_Resolution_Mac_Stock-1622403.jpg!d',true),
(3,1,'Monitor Flex 21','Natoque lacinia accumsan hendrerit pretium sociis imperdiet a, nullam ornare erat suspendisse praesent porta, euismod in augue tempus aliquet habitasse. Non accumsan nostra cras vestibulum augue facilisi auctor scelerisque suscipit, iaculis maecenas varius sollicitudin lacus netus et ultricies tincidunt, tortor curabitur tempor diam aliquet dis platea integer. Potenti aliquet erat neque vitae et sociis pretium, viverra euismod vivamus scelerisque metus est feugiat curae, parturient auctor aliquam pharetra nam congue.',24000,5,'https://www.trustedreviews.com/wp-content/uploads/sites/54/2022/09/LG-OLED-Flex-7-scaled.jpg',true),
(4,1,'Monitor Flex 36','Elementum sagittis dictumst leo curabitur porta, pellentesque interdum mauris class augue, penatibus vulputate dignissim lobortis, risus euismod ullamcorper ultrices. Hac suspendisse id odio tempus eleifend a malesuada, conubia gravida turpis auctor eget quam eu, fusce taciti lobortis sem netus cum. Etiam lacinia non nibh taciti vulputate ut nullam, curae mollis penatibus facilisi maecenas urna aptent, metus fusce felis magna ullamcorper aenean.',27600,2,'https://www.lg.com/us/images/tvs/md08003300/gallery/D-01.jpg',true),
(5,2,'Teclado español everex','Aenean senectus diam vitae curae habitant risus a et netus ante, sociis metus quisque euismod aptent etiam platea fringilla class vestibulum, dis habitasse facilisis fusce varius nam arcu blandit congue. Rutrum placerat congue etiam senectus tincidunt fringilla consequat dignissim sollicitudin, vulputate curae accumsan tempor nunc vel eros mus. Mauris donec urna ante proin duis nullam purus maecenas gravida curae iaculis, tempor quam massa cursus mollis per sodales eros diam leo.',45000,5,'https://http2.mlstatic.com/D_NQ_NP_984317-MLA43206062255_082020-O.webp',true),
(6,2,'Teclado fisico gamer','Auctor id morbi tempor litora fusce potenti, ornare integer imperdiet turpis accumsan enim, sagittis suscipit purus lacus nunc. Posuere tellus elementum imperdiet sollicitudin consequat torquent urna risus, pulvinar ac per quis egestas tristique ultricies, bibendum dignissim congue eu litora malesuada montes. Nisl arcu mi purus auctor nulla sodales torquent facilisis imperdiet, dignissim bibendum justo dictum in congue integer scelerisque sagittis, accumsan laoreet nam augue felis massa varius nostra.',57000,2,'https://psycatgames.com/magazine/party-games/gaming-trivia/feature-image_hu1c2b511a5a2ca80ffc557d83cb5157c1_380853_1200x1200_fill_q100_box_smart1.jpg',true),
(7,2,'Teclado usb compacto','Cum placerat etiam lobortis curabitur fames class facilisi hac duis, congue vulputate mus feugiat nostra imperdiet neque vehicula. Mi mollis ridiculus montes aenean sagittis vitae metus, netus massa ligula sociis magnis porttitor, torquent nisl eleifend lobortis dignissim at. Eget nostra tellus sagittis condimentum nec felis curabitur dis ad purus, montes dapibus ullamcorper cras vivamus facilisis nascetur lectus porttitor, dictum vulputate luctus pretium ligula eu posuere rhoncus molestie. Nibh platea odio at mollis est, turpis enim felis pharetra tellus placerat, facilisis praesent massa nulla. Accumsan curabitur cras mus turpis malesuada arcu aptent, volutpat praesent habitant senectus quis mollis sed, viverra nec proin nostra cubilia hendrerit.',25000,5,'https://live.staticflickr.com/7010/26783973491_3e2043edda_b.jpg',true),
(8,2,'Teclado Monitor Flex','Purus dictumst scelerisque mollis platea malesuada per vehicula lectus blandit sed, vulputate morbi imperdiet duis dapibus congue class accumsan nullam, ligula eleifend tincidunt urna mi condimentum dis posuere tellus. Sem rutrum erat mauris justo nunc odio condimentum in dictumst, cum porttitor lectus dignissim velit nulla gravida lobortis tempus vehicula, pharetra urna ullamcorper metus semper volutpat proin senectus. Aliquam donec cras ante hendrerit enim vitae nostra consequat scelerisque a habitant dictum congue ornare potenti, sodales velit litora suspendisse nullam neque pellentesque dui etiam platea imperdiet pretium luctus.',27600,2,'https://hardzone.es/app/uploads-hardzone.es/2020/10/Mejores-KVM.jpg',true),
(9,3,'CPU Intel 7i','Morbi egestas sociis magnis curabitur suscipit nostra blandit magna torquent convallis, enim parturient feugiat fringilla litora aliquam turpis nisl at velit, fames aenean dui viverra arcu habitasse nascetur platea ac. Lectus nibh imperdiet nascetur proin potenti nisl mattis fringilla urna consequat diam, pellentesque vulputate magnis ridiculus dignissim nec venenatis primis ut bibendum, penatibus himenaeos mus sapien magna etiam velit justo vivamus metus. Tellus volutpat hendrerit vehicula lacinia aliquam euismod lectus erat posuere, arcu nec morbi dui placerat quisque semper tempor vulputate est, turpis ac dis nostra congue odio per mattis.',15780,5,'https://live.staticflickr.com/7391/9662276651_f4aa27d5ca_b.jpg',true),
(10,3,'CPU Intel Core 5i','Rhoncus ante magna cursus consequat proin senectus ridiculus, varius maecenas tellus justo facilisi ligula eros dapibus, taciti sollicitudin vulputate vivamus lacus fusce. Lacus aptent facilisi urna volutpat vestibulum nunc sociis viverra habitasse egestas, vivamus blandit ultricies neque netus pulvinar elementum ac per iaculis, donec euismod porttitor velit diam ullamcorper congue phasellus nam. Feugiat senectus parturient tristique enim ac integer torquent rutrum imperdiet, nec dapibus nam vestibulum sodales phasellus dis egestas urna, donec interdum id dictumst mollis nostra felis euismod. Ornare proin diam lobortis enim maecenas tempus scelerisque nascetur, id quam magna fames vitae posuere luctus tempor, interdum mattis et ac sapien imperdiet ante.',15000,2,'https://live.staticflickr.com/1473/24714440462_31a0fcdfba_b.jpg',true),
(11,3,'AMD 7500','Primis quis sollicitudin ac himenaeos dui metus ridiculus, viverra vitae erat litora mauris eget, ut nisl platea feugiat inceptos cum. Diam vitae sem nulla commodo hendrerit duis dictum, tristique senectus maecenas eu augue dignissim lectus, eros cursus felis ornare nisl primis. Tempor facilisi ad scelerisque himenaeos nec ultrices interdum praesent, tincidunt mauris morbi nostra et parturient vivamus odio viverra, eget eu fermentum conubia vestibulum sagittis feugiat. Nulla mus dis rutrum feugiat imperdiet sociosqu non augue tempor sem, arcu natoque ridiculus odio dapibus quis ligula sagittis dui.',25400,5,'https://upload.wikimedia.org/wikipedia/commons/0/0c/AMD_Ryzen_9_3900X_-_ISO.jpg',true),
(12,3,'AMD 670','Risus tristique donec faucibus cursus dictumst vestibulum maecenas, ac scelerisque luctus purus senectus quisque pellentesque, dictum commodo accumsan himenaeos placerat suscipit. Pharetra erat cubilia sapien feugiat aenean molestie vulputate ac, lectus phasellus rutrum pretium interdum a natoque varius parturient, pulvinar condimentum praesent mollis ante nulla inceptos. Curabitur vestibulum malesuada justo non nostra nam donec dictum platea, commodo dictumst natoque bibendum leo nibh cras habitant primis, quisque augue eget ultrices pulvinar sodales odio rhoncus. Diam condimentum id pellentesque imperdiet porttitor vestibulum himenaeos iaculis, natoque ornare scelerisque nam nostra taciti tortor malesuada, sapien lacus cubilia suspendisse eros rutrum conubia.',45000,3,'https://upload.wikimedia.org/wikipedia/commons/a/a0/AMD_Duron_850_MHz_D850AUT1B.jpg',true),
(13,4,'Samsung S22','Nam ad hac curae mollis dui scelerisque convallis eros, dignissim faucibus velit nostra dapibus cursus vehicula habitasse facilisi, mi conubia pellentesque quisque cras justo inceptos. Integer varius consequat volutpat at dui scelerisque dapibus magnis platea quis, purus mi nibh tempor inceptos litora hac himenaeos ultrices. Convallis orci dictumst tincidunt phasellus facilisis ullamcorper montes vestibulum, leo cubilia tempus fringilla sodales per lacus viverra pretium, potenti id sociis fames curae nam etiam.',285000,0,'https://www.trustedreviews.com/wp-content/uploads/sites/54/2022/08/S22-app-drawer-scaled.jpg',true),
(14,4,'Motorola X23','Luctus lacus montes vulputate libero purus est litora, risus magnis quisque ac urna magna sollicitudin, suspendisse mauris massa euismod quam placerat. Facilisis congue id posuere tortor et porttitor curabitur pulvinar sapien, cubilia tempus pharetra facilisi fringilla dapibus lectus non hendrerit, pellentesque dictumst vulputate natoque molestie aptent nascetur ante. Laoreet etiam taciti integer at metus facilisis, pellentesque tortor leo enim felis turpis bibendum, neque curabitur himenaeos hac torquent.',154000,0,'https://www.trustedreviews.com/wp-content/uploads/sites/54/2021/10/motorola-2.jpg',true),
(15,4,'Nokia 5430','Nullam porttitor vivamus phasellus tempus in morbi aliquet platea duis, nulla tristique inceptos pellentesque pulvinar congue sagittis euismod vitae lacinia, scelerisque mus orci sociosqu libero proin sed felis. Pretium tincidunt ultrices eu vel nam massa morbi diam sem, neque aliquet vehicula penatibus odio phasellus curabitur. Conubia natoque quis tellus scelerisque sociis facilisi nisi suspendisse, id interdum ornare vivamus proin himenaeos class sed in, suscipit torquent est aliquam orci nunc etiam. Congue et nisl magna cum id sociis enim suscipit integer, nisi egestas est porttitor sollicitudin commodo natoque pharetra torquent, aliquam euismod nam porta rhoncus non ante habitasse.',330000,0,'https://www.trustedreviews.com/wp-content/uploads/sites/54/2021/08/nokia-xr20-1.jpg',true),
(16,4,'Xiami x45','Litora metus senectus mattis egestas mus fames tempus suscipit, inceptos luctus hendrerit congue quis sem. Potenti quis conubia fermentum non dictum nibh, viverra neque sed pretium eros aptent, metus hac at imperdiet est. Accumsan donec sociosqu etiam venenatis felis aenean suspendisse facilisi dignissim conubia non, molestie est ultrices neque id diam pellentesque quis quisque in odio, per nulla aptent arcu vehicula lobortis aliquet tempor cum platea.',273000,0,'https://www.trustedreviews.com/wp-content/uploads/sites/54/2022/03/20220315_104812-1-scaled.jpg',true),
(17,2,'Audifonos RadioShack','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',18000,2,'https://www.gollo.com/media/catalog/product/3/7/3707040023_zhwbvok9hajqm3ta.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=1040&width=1040&canvas=1040:1040',true),
(18,2,'Audifonos RGB','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',23000,4,'https://cometware.com/media/catalog/product/cache/214fe12795aff2ab2f43d448208cb7ca/a/g/ag7rs2204120ejwuj77.jpg',true),
(19,2,'Audifonos Onikuma','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',31000,5,'https://cdnx.jumpseller.com/gti-electronica/image/19976732/resize/640/640?1634312955',true),
(20,2,'Audifonos Logitech','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',28000,3,'https://www.tiendamonge.com/media/catalog/product/a/u/audifonos-gaming-logitech-939-002083-a10-verde-181355.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700',true),
(21,5,'Control Ps5','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',48000,4,'https://www.tiendamonge.com/media/catalog/product/1/7/171197_1_1.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700',true),
(22,5,'Control Ps4 Rojo','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',25000,2,'https://mastecsa.com/wp-content/uploads/2020/12/Control-PS4-ROJO.png',true),
(23,5,'Control Xbox','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',22000,3,'https://assets.xboxservices.com/assets/13/85/138560bf-8a3b-47d2-b32c-ab5a053a25ab.png?n=XBX_A-BuyBoxBGImage04-D.png',true),
(24,5,'Control Xbox Azul','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',24000,2,'https://assets.xboxservices.com/assets/8e/d4/8ed4fb28-7a81-4abe-94e4-c5327b25e697.jpg?n=Accessories-Hub_Content-Placement-0_2020-Controller-Blue_788x444.jpg',true),
(25,6,'Nikon Lente18','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',55000,3,'https://heredia.solutekla.com/photo/1/nikon/camaras_profesionales/camara_profesional_nikon_d5600_lente1855mm/camara_profesional_nikon_d5600_lente1855mm_0001',true),
(26,6,'Camara instantanea','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',32000,4,'https://innovacellcr.com/cdn/shop/files/camara-instantanea-instax-mini-11-innovacell-1.png?v=1691017331',true),
(27,6,'Camara para auto','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',18000,2,'https://www.steren.cr/media/catalog/product/cache/532829604b379f478db69368d14615cd/image/201010891/camara-para-auto-con-grabador-full-hd-y-wdr.jpg',true),
(28,6,'Camara de seguridad','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',27000,3,'https://m.media-amazon.com/images/I/41AvBE37uyL._AC_UF894,1000_QL80_.jpg',true),
(29,7,'Mavix Pro','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',73000,3,'https://www5.djicdn.com/cms/uploads/50e3b2ee239a7c2c04c2e1bbb16963ad.png',true),
(30,7,'Mini Dron','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',22000,2,'https://readwrite.com/wp-content/uploads/2023/05/Best-Mini-Drones-825x500.jpg',true),
(31,7,'Dron VAK K1','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',82000,4,'https://i5.walmartimages.com.mx/mg/gm/3pp/asr/b5da58e9-a511-4e81-a933-ed32bc04b6dd.7a51baf88cc83446ce521ae63f79dd07.jpeg?odnHeight=2000&odnWidth=2000&odnBg=ffffff',true),
(32,7,'Dron Holy','Lorem ipsum dolor sit amet consectetur adipiscing elit iaculis, ullamcorper in fringilla eu cras tempor mi. Luctus blandit sapien mauris vestibulum consequat mattis taciti aliquam ullamcorper, sagittis suscipit etiam urna convallis interdum tempor bibendum, ultricies habitant viverra natoque dictum posuere senectus volutpat. Cum ad vehicula condimentum nunc lacus nec tellus eleifend, a platea curae nullam sollicitudin nibh class cursus taciti, posuere purus inceptos facilisis cubilia suspendisse ut.',89000,3,'https://cdn.pacifiko.com/image/cache/catalog/p/MzFhMThhZD-484x484.jpg',true);

/*Se crean 6 facturas */   /*'Activa','Pagada','Anulada')*/
INSERT INTO valhalla.factura (id_factura,id_usuario,fecha,total,estado) VALUES
(1,1,'2022-01-05',211560,2),
(2,2,'2022-01-07',554340,2),
(3,3,'2022-01-07',871000,2),
(4,1,'2022-01-15',244140,1),
(5,2,'2022-01-17',414800,1),
(6,3,'2022-01-21',420000,1);

INSERT INTO valhalla.venta (id_venta,id_factura,id_producto,precio,cantidad) values
(1,1,5,45000,3),
(2,1,9,15780,2),
(3,1,10,15000,3),
(4,2,5,45000,1),
(5,2,14,154000,3),
(6,2,9,15780,3),
(7,3,14,154000,1),
(8,3,6,57000,1),
(9,3,15,330000,2),
(10,1,6,57000,2),
(11,1,8,27600,3),
(12,1,9,15780,3),
(13,2,8,27600,3),
(14,2,14,154000,2),
(15,2,3,24000,1),
(16,3,15,330000,1),
(17,3,12,45000,1),
(18,3,10,15000,3);