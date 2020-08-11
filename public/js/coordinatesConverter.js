function GeoToUTM(latV, lonV){
    var xy = new Array(2);
    if (isNaN (parseFloat (lonV))) {
        alert ("Por favor ingrese una longitud valida.");
        return false;
    }

    lon = parseFloat (lonV);

    if ((lon < -180.0) || (180.0 <= lon)) {
        alert ("La longitud ingresada esta fuera de rango.  " +
                "Por favor ingrese un valor comprendido entre [-180, 180).");
        return false;
    }

    if (isNaN (parseFloat (latV))) {
        alert ("Por favor ingrese una latitud valida.");
        return false;
    }

    lat = parseFloat (latV);

    if ((lat < -90.0) || (90.0 < lat)) {
        alert ("La latitud ingresada esta fuera de rango.  " +
                "Por favor ingrese un valor comprendido entre [-90, 90].");
        return false;
    }

    // Compute the UTM zone.

    zone = Math.floor ((lon + 180.0) / 6) + 1
    zone = LatLonToUTMXY (DegToRad (lat), DegToRad (lon), zone, xy);

    /* Set the output controls.  */

    var res=new Object();
    res['X']=xy[0];
    res['Y']=xy[1];
    res['zone']=zone;
    res['hemisferio']=(lat<0)?'S':'N';
    return res;
}


function UtmToGeo(xV,yV,zoneV,hemisferioV){
    latlon = new Array(2);
    var x, y, zone, southhemi;

    if (isNaN (parseFloat (xV))) {
        alert ("Por favor ingrese un valor valido para X.");
        return false;
    }

    x = parseFloat (xV);

    if (isNaN (parseFloat (yV))) {
        alert ("Por favor ingrese un valor valido para Y.");
        return false;
    }

    y = parseFloat (yV);

    if (isNaN (parseInt (zoneV))) {
        alert ("Por favor ingrese una zona valida de UTM.");
        return false;
    }

    zone = parseFloat (zoneV);

    if ((zone < 1) || (60 < zone)) {
        alert ("El valor de zona de UTM esta fuera de rango.  " +
                "Por favor ingrese un valor entre [1, 60].");
        return false;
    }

    if (hemisferioV == true)
        southhemi = true;
    else
        southhemi = false;

    UTMXYToLatLon (x, y, zone, southhemi, latlon);

    var res=new Object();
    res['lat']=RadToDeg (latlon[0]);
    res['lon']=RadToDeg (latlon[1]);

    return res;
}

function pointRadialDistanceV1(lat,lon,distance,azimut) {
    var utmPlataforma=GeoToUTM(lat,lon);
    //var lineDirectionX=utmPlataforma['X']+10000*Math.sin(DegToRad(180-90-azimutPlataforma))/Math.sin(DegToRad(90));
    //var lineDirectionY=utmPlataforma['Y']+10000*Math.sin(DegToRad(azimutPlataforma))/Math.sin(DegToRad(90));
    var lineDirectionX=utmPlataforma['X']+distance*Math.sin(DegToRad(azimut));
    var lineDirectionY=utmPlataforma['Y']+distance*Math.cos(DegToRad(azimut));
    var geoLineaDirection=UtmToGeo(lineDirectionX,lineDirectionY,utmPlataforma['zone'],(utmPlataforma['hemisferio']=='S')?true:false);
    return geoLineaDirection;
}

function mapeo(x, in_min, in_max, out_min, out_max) {
    return (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}

function regularizarAzimut(azimut) {
    /*if (azimut<0) {
        return azimut+360;
    } else if (azimut>360) {
        azimut
    }*/
}

function pointRadialDistanceV2(lat1,lon1,distance,azimut) {
    var earthRadius = sm_a; //6378137.0 WGS84 sm_a  6371000 -> Wikipedia
    var epsilon = 0.000001;
    var rlat1=DegToRad(lat1);
    var rlon1=DegToRad(lon1);
    //azimut = regularizarAzimut(azimut);
    //var azimut():
    var razimut=DegToRad(mapeo(azimut,0,360,360,0));
    var rdistance=distance/earthRadius;

    var rlat=Math.asin(Math.sin(rlat1)*Math.cos(rdistance)+Math.cos(rlat1)*Math.sin(rdistance)*Math.cos(razimut));
    var rlon=0;
    if (Math.cos(rlat)==0 || Math.abs(Math.cos(rlat))<epsilon) {
        rlon=rlon1;
    } else {
        rlon=((rlon1-Math.asin(Math.sin(razimut)*Math.sin(rdistance)/Math.cos(rlat))+pi)%(2*pi))-pi;
    }
    var res=new Object();
    res['lat']=RadToDeg(rlat);
    res['lon']=RadToDeg(rlon);
    return res;
}

function getDistanceFromLatLon(lat1, lon1, lat2, lon2) {
    var R = sm_a; // metres
    var φ1 = DegToRad(lat1);
    var φ2 = DegToRad(lat2);
    var Δφ = DegToRad(lat2-lat1);
    var Δλ = DegToRad(lon2-lon1);

    var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ/2) * Math.sin(Δλ/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return d;
}

function calculateAzimut(lat1,lon1,lat2,lon2) {
    var φ1 = DegToRad(lat1), φ2 = DegToRad(lat2);
    var Δλ = DegToRad(lon2-lon1);
    var y = Math.sin(Δλ) * Math.cos(φ2);
    var x = Math.cos(φ1)*Math.sin(φ2) -
            Math.sin(φ1)*Math.cos(φ2)*Math.cos(Δλ);
    var θ = Math.atan2(y, x);

    return (RadToDeg(θ)+360) % 360;
}