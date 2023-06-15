document.querySelectorAll(".swatch").forEach((s, i) => {
	let fill = s.getAttribute("data-fill");
	if (i === 0) {
		const bod = document.querySelector("body");
		bod.setAttribute("style", `background-color: ${fill};`);
	}
	s.setAttribute("style", `background-color: ${fill};`);
	s.addEventListener("click", () => {
		console.log(`copied ${fill} to clipboard`);
		navigator.clipboard.writeText(fill);
	});
});
