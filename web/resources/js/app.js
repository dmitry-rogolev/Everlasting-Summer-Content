var jquery = document.createElement("script");
jquery.setAttribute("src", "https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js");

var bootstrap = document.createElement("script");
bootstrap.setAttribute("src", "https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js");

var script = document.getElementsByTagName("script").item(0);

script.before(jquery);
script.before(bootstrap);
