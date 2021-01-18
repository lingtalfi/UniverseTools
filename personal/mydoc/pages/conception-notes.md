Conception notes
========
2020-12-08 -> 2021-01-18






The planets and assets/map
=========
2020-12-08

The **assets/map** directory is an unofficial convention used by all planets in the **Ling** galaxy.

The promise is that anything stored into this directory will be mapped to the current application when the planet is
imported into that application.

This trick was used by
the [Uni2 installer](https://github.com/lingtalfi/Uni2): [uni](https://github.com/lingtalfi/universe-naive-importer).

We've decided to make it "official" by incorporating into our tools.

You can now import a planet using our **PlanetTool::importPlanetByExternalDir** method, which copies both the source
planet directory and the **assets/map** to the target application.

We've also the **PlanetTool::removePlanet** method, which does the opposite: remove the **assets/map** files, then the
source planet directory.

Note that when we remove **assets/map** files, we only remove files, not directories, as a directory might potentially
be used by other third-party authors.

### assets/map example

So for instance, let's say your planet is named **Ling/ABC** and has the following structure:

- universe/Ling/ABC/:
    - assets/map/:
        - config/abc.byml
        - www/templates/abc.html

Then when you import the **Ling/ABC** planet into the app, the app will look like this:

- app/
    - universe/Ling/ABC/
    - config/abc.byml
    - www/templates/abc.html


