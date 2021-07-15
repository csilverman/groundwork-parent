## groundwork-parent

Welcome to Groundwork. Groundwork is a starter WordPress theme, built on the excellent [underscores](https://underscores.me/) theme from [Automattic](https://automattic.com/). (I'm aware there is an abandoned theme out there from 2015 that is also called GroundWork; I'm not really worried about that at this point.)

### What this is and isn't

As the name implies, Groundwork is a parent theme. It's not intended to contain any styling, and in fact it shouldn't be modified at all. I'll say it now: you're welcome to experiment with it, but Groundwork is *not* production-ready at this point.

Groundwork came about when I realized that I kept having to make the same starter theme modifications over and over again. In some projects, I wanted to have a post author's name visible, and in others I didn't. Or I might want to include the author's avatar. Sometimes I wanted to change the "Filed under" title for categories to some other text. And of course I kept having to change the template markup to use the [BEM naming system](http://getbem.com/naming/). I realized I could save a lot of time by building all these changes into one theme that every other project was based on, and configuring them as needed via a config file.

So Groundwork is a theme that incorporates every common modification I'd need to make, accessible via config variables. I'm putting it out here in case it's useful, but it's a mess right now—something I hope to remedy in the [Coherence project](https://github.com/csilverman/groundwork-parent/projects/2).

Groundwork is not a builder theme. It's not designed to addres any needs other than my own, and it may not be suitable for large, complex sites. It's essentially a Swiss-Army-knife theme.

### How to use it

- Download Groundwork
- Download the [Groundwork-child](https://github.com/csilverman/groundwork-child) theme
- Build your site in Groundwork-child, and change configurations in the child theme's _SETUP.php file.

Do not make any changes to the parent theme itself. Groundwork-parent should be upgradeable by replacing the entire theme with the upgraded version, so nothing site-specific should go in that theme.
